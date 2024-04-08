<x-app-layout>
    <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Devices') }}
            </h2>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <form method="GET" action="{{ route('user.devices.index') }}">
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


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                @foreach($devices as $device)
                <div class="card bg-gray-200 text-light text-center rounded-4 p-2 pb-0 shadow border-0">
                    {{-- <a href="{{ route('user.devices.show', $device) }}">
                    <img src="{{ $device->device_cover }}" class="rounded-4" alt="...">
                    </a> --}}
                    <a href="{{ route('user.devices.show', $device) }}">
                        @if ($device->device_cover)
                        <img src="{{ asset($device->device_cover) }}" alt="{{ $device->model }}" class="rounded-4" alt="...">
                        @else
                        No Image
                        @endif
                    </a>
                    <div class="card-body">
                        <a href="{{ route('user.devices.show', $device) }}">
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

       <div class="container max-w-5xl my-10 mx-auto ">
            <div class="pagination-links">
                {{ $devices->links() }}
            </div>
        </div>

    <div class="container max-w-5xl my-10 mx-auto ">
                <div class="mx-0 sm:mx-6">
                    <!--Subscribe-->
                    <div class="container font-sans bg-gray-200 rounded mt-8 p-4 md:p-24 text-center">
                        <h2 class="font-bold break-normal text-2xl md:text-4xl">Subscribe to EthiTech</h2>
                        <h3 class="font-bold break-normal font-normal text-gray-600 text-base md:text-xl">Get the latest posts delivered right to your inbox</h3>
                        <div class="w-full text-center pt-4">
                            <form action="#">
                                <div class="max-w-sm mx-auto p-1 pr-0 flex flex-wrap items-center">
                                    <input type="email" placeholder="youremail@example.com" class="flex-1 appearance-none rounded shadow p-3 text-gray-600 mr-2 focus:outline-none">
                                    <button type="submit" class="flex-1 mt-4 md:mt-0 block md:inline-block appearance-none bg-gray-500 text-white text-base font-semibold tracking-wider uppercase py-4 rounded shadow hover:bg-green-400">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Subscribe-->
                </div>
            </div>
    </div>
</x-app-layout>
