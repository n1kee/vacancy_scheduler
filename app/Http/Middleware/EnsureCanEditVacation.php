<?php

namespace App\Http\Middleware;

use App\Models\Vacation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCanEditVacation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        $userIdMismatch = $id && ($request->user()->id != $id);

        $vacation = $id ? Vacation::where('id', $id)->first() : new Vacation;

        if ($id && ! $vacation) {
            return redirect('/')
                ->withMessage('Not found !')
                ->send();
        }

        if ($userIdMismatch || $vacation->approved) {
            return redirect('/')
                ->withMessage('Unauthorized !')
                ->send();
        }

        $request->merge(['vacation' => $vacation]);

        return $next($request, $vacation);
    }
}
