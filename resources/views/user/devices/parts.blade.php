<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Parts for {{ $device->model }}
        </h2>
    </x-slot>

    <div class="container">
    <!-- Page Content -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 m-4">
        @foreach($parts as $part)
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $part->heading }}</h5>
            </a>
            <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Official Manufacturer Part?</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $part->oem }}</p>
            <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">EthiTech Reccommended?</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $part->admin_rec }}</p>
            <a href="{{ $part->part_url }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Buy Here
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
        @endforeach
    </div>
    </div>

    </div>

    </div>
    </div>
</x-app-layout>
