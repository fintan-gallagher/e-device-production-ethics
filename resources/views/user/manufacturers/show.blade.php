<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $manufacturer->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Display manufacturer details -->

            <div class="card lg:card-side bg-gray-300 shadow-xl flex">
                <figure class="w-1/2"><img src="{{asset($manufacturer->manufacturer_img)}}" alt="Manufacturer" /></figure>
                <div class="card-body w-1/2 m-4">
                    <h1 class="font-bold">Name</h2>
                        <p>{{$manufacturer->name}}</p>
                        <h1 class="font-bold">Address</h1>
                        <p>{{ $manufacturer->address }}</p>
                        <h1 class="font-bold">Email</h2>
                            <p>{{ $manufacturer->email }}</p>
                            <h1 class="font-bold">Ethics Score</h2>
                                <div class="w-full bg-gray-200 rounded-full">
                                    <div class="h-4 bg-blue-500 rounded-full flex items-center justify-center text-white" style="width: {{ $manufacturer->ethics_score }}%;">
                                        {{ $manufacturer->ethics_score }}%
                                    </div>
                                </div>
                                <h1 class="font-bold">Biography</h2>
                                    <p>{{$manufacturer->bio}}</p>
                                    <h1 class="font-bold">Read More:</h1>
                                    <p>
                                        @if($manufacturer->sustainable)
                                        <a href="{{ route('user.sustainables.show', $manufacturer->sustainable->id) }}" class="text-blue-500 hover:underline">
                                            {{ $manufacturer->name }}
                                        </a>
                                        @else
                                        @endif
                                    </p>

                </div>
            </div>

            <!-- Display devices for the manufacturer -->

            <h3 class="font-bold text-2xl mt-6 mb-4">Devices by {{ $manufacturer->name }}</h3>

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
                                    <button type="submit" class="flex-1 mt-4 md:mt-0 block md:inline-block appearance-none bg-gray-500 text-white text-base font-semibold tracking-wider uppercase py-4 rounded shadow hover:bg-blue-400">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Subscribe-->
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
