<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveVacationRequest;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacationController extends Controller
{
    public function edit(SaveVacationRequest $request, Vacation $vacation)
    {

        $id = $request->route('id');

        $vacation = $request->vacation;

        return view('vacation.edit', [
            'user' => $request->user(),
            'vacation' => $vacation,
        ]);
    }

    public function list(Request $request)
    {

        $vacationList = Vacation::all();

        return view('vacation.list', [
            'user' => $request->user(),
            'vacationList' => $vacationList,
        ]);
    }

    public function update(SaveVacationRequest $request)
    {

        $id = $request->route('id');

        $data = [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'user_id' => $request->user()->id,
        ];

        if ($id) {

            $vacation = $request->vacation;
            $vacation->update($data);

        } else {

            $vacation = Vacation::create($data);

        }

        return redirect()->route('vacation.list')->withMessage('Saved !');
    }

    public function approve(Request $request)
    {

        $id = $request->route('id');

        if (! $request->user()->is_manager) {
            return redirect()->back()->withMessage('Unauthorized !');
        }

        $vacation = Vacation::whereId($id)->first();

        $vacation->approved = true;

        $vacation->save();

        return redirect()->back()->withMessage('Saved !');
    }
}
