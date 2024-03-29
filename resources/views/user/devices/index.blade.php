<x-app-layout>
    <x-slot name="header">
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Devices') }}
        </h2>
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <form method="GET" action="{{ route('user.devices.index') }}">
                <input type="text" name="search" placeholder="Search devices" value="{{ request('search') }}">
                <x-primary-button type="submit">Search</x-primary-button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>



            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Model</th>
                        <th class="px-4 py-2">Parts Available?</th>
                        <th class="px-4 py-2">Release Year</th>
                        <th class="px-4 py-2">Manufacturer</th>
                        <th class="px-4 py-2">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($devices as $device)
                        <tr>
                            <td class="px-4 py-2">
                                <a href="{{ route('user.devices.show', $device) }}">{{ $device->model }}</a>
                            </td>

                            <td class="px-4 py-2">{{ $device->parts_availability }}</td>
                            <td class="px-4 py-2">{{ $device->release_year }}</td>
                            <td class="px-4 py-2">{{ $device->manufacturer ? $device->manufacturer->name : 'No Manufacturer' }}</td>
                            <td class="px-4 py-2">
                                @if ($device->device_cover)
                                    <img src="{{ asset($device->device_cover) }}" alt="{{ $device->model }}" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-2" colspan="4">No devices</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- <div class="pagination-links">
            {{ $devices->links() }}
        </div> --}}
    </div>
</x-app-layout>
