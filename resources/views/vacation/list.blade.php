<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('List of vacations') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div>
                <section>

                    <div class="mt-1">
                        @if (!$user->is_manager)
                        <a
                            href="{{ route('vacation.new') }}"
                        >{{ __('Create a vacation') }}</a>
                        @endif
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Employee name</th>
                                <th>Vacation start</th>
                                <th>Vacation end</th>
                                <th>Is approved</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vacationList as $vacation)
                            <tr>
                                <td>{{ $vacation->user->name }}</td>
                                <td>{{ $vacation->start_date }}</td>
                                <td>{{ $vacation->end_date }}</td>
                                <td>{{ $vacation->approved ? 'Yes' : 'No' }}</td>
                                <td>
                                    @if (!$vacation->approved)
                                    <div>
                                        @if ($user->id === $vacation->user->id)
                                        <a
                                            href="{{ route('vacation.edit', $vacation->id) }}"
                                        >{{ __('Edit') }}</a>
                                        @endif
                                    </div>
                                    <div>
                                        @if ($user->is_manager)
                                        <a
                                            href="{{ route('vacation.approve', $vacation->id) }}"
                                        >{{ __('Approve') }}</a>
                                        @endif
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

            </div>
        </div>
    </div>
</div>
<style type="text/css">
    th, td {
        padding: 15px;
    }
</style>
</x-app-layout>
