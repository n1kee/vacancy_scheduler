<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Vacation') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>

                    <div class="mt-3">
                        <a
                            href="{{ route('vacation.list') }}"
                        >{{ __('Go to list of vacations') }}</a>
                    </div>

                    <header class="mt-3">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Vacation dates') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Update your vacations's dates.") }}
                        </p>
                    </header>

                    <form id="send-verification" method="post" action="{{ route('vacation.update') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('vacation.update', ['id' => $vacation->id]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="start_date" :value="__('Start date')" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $vacation->start_date)" required autofocus autocomplete="start_date" />
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>

                        <div>
                            <x-input-label for="end_date" :value="__('End date')" />
                            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', $vacation->end_date)" required autocomplete="end_date" />
                            <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                        </div>

                        @if ($vacation instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $vacation->id)
                        @endif

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>

            </div>
        </div>
    </div>
</div>
</x-app-layout>
