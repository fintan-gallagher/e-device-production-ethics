<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <!--Main-->
    <div class="container pt-24 md:pt-48 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">

        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.devices.index') }}" class="{{ request()->routeIs('admin.devices.index') ? 'active' : '' }} mx-auto my-10">
                <x-application-logo class="h-24 fill-current text-indigo-600" xmlns="" viewBox="0 0 20 20"></x-application-logo>
            </a>
        @elseif(auth()->user()->hasRole('user'))
            <a href="{{ route('user.devices.index') }}" class="{{ request()->routeIs('user.devices.index') ? 'active' : '' }} mx-auto my-10">
                <x-application-logo class="h-24 fill-current text-indigo-600" xmlns="" viewBox="0 0 20 20"></x-application-logo>
            </a>
        @endif

        <!--Left Col-->
        <div class="flex flex-col w-full xl:w-full justify-center overflow-y-hidden">
            <h1 class="my-4 text-3xl md:text-5xl text-blue-500 font-bold leading-tight text-center md:text-center slide-in-bottom-h1">Welcome to EthiTech!</h1>
            <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-center slide-in-bottom-subtitle">Saving the planet, one device at a time</p>
        </div>
    </div>
</x-app-layout>
