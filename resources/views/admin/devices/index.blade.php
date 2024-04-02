<x-app-layout>
    <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Devices') }}
            </h2>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <form method="GET" action="{{ route('admin.devices.index') }}">
                    <input type="text" name="search" placeholder="Search devices" value="{{ request('search') }}">
                    <select name="order_by">
                        <option value="">Order by</option>
                        <option value="recycled">Recycled (Highest to Lowest)</option>
                        <option value="repairability">Repairability (Highest to Lowest)</option>
                        <option value="price">Price (Highest to Lowest)</option>
                    </select>
                    <x-primary-button type="submit">Search</x-primary-button>
                </form>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <x-primary-button>
                <a href="{{ route('admin.devices.create') }}">Add a Device</a>
            </x-primary-button>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                @foreach($devices as $device)
                <div class="card bg-gray-200 text-light text-center rounded-4 p-2 pb-0 shadow border-0">
                    {{-- <a href="{{ route('admin.devices.show', $device) }}">
                    <img src="{{ $device->device_cover }}" class="rounded-4" alt="...">
                    </a> --}}
                    <a href="{{ route('admin.devices.show', $device) }}">
                        @if ($device->device_cover)
                        <img src="{{ asset($device->device_cover) }}" alt="{{ $device->model }}" class="rounded-4" alt="...">
                        @else
                        No Image
                        @endif
                    </a>
                    <div class="card-body">
                        <a href="{{ route('admin.devices.show', $device) }}">
                            <h5 class="card-title text-primary text-start"><span class="font-bold">Model: </span>{{ $device->model }}</h5>
                        </a>
                        <p class="card-text text-start text-secondary"><span class="font-bold">Manufacturer: </span>{{ $device->manufacturer ? $device->manufacturer->name : 'No Manufacturer' }}</p>
                        <p class="card-text text-start text-secondary"><span class="font-bold">Release Date: </span>{{ substr($device->release_year, 0,4) }}</p>
                        <p class="text-primary text-start small"><span class="font-bold">Price: </span>€{{ $device->price }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
         <div class="pagination-links">
        {{ $devices->links() }}
    </div>
    </div>
</x-app-layout>
