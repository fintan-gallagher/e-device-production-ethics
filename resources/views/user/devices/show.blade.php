<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $device->model }}
        </h2>
    </x-slot>

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <div class="my-6 p-6 bg-gray-200 border-b border-gray-200 shadow-sm sm:rounded-lg">
                <div class="card lg:card-side bg-gray-300 shadow-xl flex">
                    <figure class="w-1/2"><img src="{{asset($device->device_cover)}}" alt="Album" /></figure>
                    <div class="card-body w-1/2 m-4">
                        <h1 class="font-bold">Model</h2>
                            <p>{{$device->model}}</p>
                            <h1 class="font-bold">Are Parts Available?</h1>
                            <p>{{$device->parts_availability}}</p>
                            @if($device->parts_availability == 'Yes')
                            <a href="{{ route('user.devices.parts', $device) }}" class="text-blue-500 hover:underline">View Parts</a>
                            @endif
                            <h1 class="font-bold">Repairability</h2>
                                <div class="w-full bg-gray-200 rounded-full">
                                    <div class="h-4 bg-blue-500 rounded-full flex items-center justify-center text-white" style="width: {{ $device->repairability }}%;">
                                        {{ $device->repairability }}/100
                                    </div>
                                </div>
                                <h1 class="font-bold">Recyclability</h2>
                                    <div class="w-full bg-gray-200 rounded-full">
                                        <div class="h-4 bg-blue-500 rounded-full flex items-center justify-center text-white" style="width: {{ $device->recycled }}%;">
                                            {{ $device->recycled }}%
                                        </div>
                                    </div>
                                    <h1 class="font-bold">Price</h2>
                                        <p>€{{$device->price}}</p>
                                        <h1 class="font-bold">Manufacturer</h2>
                                            <p>
                                                @if($device->manufacturer)
                                                <a href="{{ route('user.manufacturers.show', $device->manufacturer->id) }}" class="text-blue-500 hover:underline">
                                                    {{ $device->manufacturer->name }}
                                                </a>
                                                @else
                                                No Manufacturer
                                                @endif
                                            </p>
                    </div>
                </div>



                 <h3 class="font-bold text-2xl mt-6 mb-4">Repair Guides for {{ $device->model }}</h3>

                @forelse ($repairguides as $repairguide)
                <x-card>
                    <h1 class="font-bold text-2xl"><a href="{{ $repairguide->guide }}" target="_blank">{{ $repairguide->heading }}</a></h1>
                </x-card>
                @empty
                <p>No repair guides for this manufacturer</p>
                @endforelse

                @unless($recommendedDevices->isEmpty())
                <h3 class="font-bold text-2xl mt-6 mb-4">Recommended Devices: Repairability</h3>
                <div class="container w-full max-w-6xl mx-auto px-2 py-8">
                    <div class="flex flex-wrap -mx-2">
                        @foreach ($recommendedDevices as $recommendedDevice)
                        <div class="w-full sm:w-1/2 md:w-1/3 px-2 pb-12">
                            <div class="h-full bg-white rounded overflow-hidden shadow-md hover:shadow-lg relative smooth">
                                <a href="{{ route('user.devices.show', $recommendedDevice) }}" class="no-underline hover:no-underline">
                                    <img src="{{ asset($recommendedDevice->device_cover) }}" class="w-full rounded-t shadow-lg object-cover w-full h-72">
                                    <div class="p-6 h-auto">
                                        <p class="text-gray-600 text-xs md:text-sm">DEVICE</p>
                                        <div class="font-bold text-xl text-gray-900">{{$recommendedDevice->manufacturer->name}} {{ $recommendedDevice->model }}</div>
                                        <p>Repairability:</p>
                                        <div class="w-full bg-gray-200 rounded-full">
                                            <div class="h-4 bg-blue-500 rounded-full flex items-center justify-center text-white" style="width: {{ $recommendedDevice->repairability }}%;">
                                                {{ $recommendedDevice->repairability }}/100
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endunless

                @unless($recycledDevices->isEmpty())
                <h3 class="font-bold text-2xl mt-6 mb-4">Recommended Devices: Recyclability</h3>

                <div class="container w-full max-w-6xl mx-auto px-2 py-8">
                    <div class="flex flex-wrap -mx-2">
                        @foreach ($recycledDevices as $recycledDevice)
                        <div class="w-full sm:w-1/2 md:w-1/3 px-2 pb-12">
                            <div class="h-full bg-white rounded overflow-hidden shadow-md hover:shadow-lg relative smooth">
                                <a href="{{ route('user.devices.show', $recycledDevice) }}" class="no-underline hover:no-underline">
                                    <img src="{{ asset($recycledDevice->device_cover) }}" class="w-full rounded-t shadow-lg object-cover w-full h-72">
                                    <div class="p-6 h-auto">
                                        <p class="text-gray-600 text-xs md:text-sm">DEVICE</p>
                                        <div class="font-bold text-xl text-gray-900">{{ $recycledDevice->manufacturer->name }} {{ $recycledDevice->model }}</div>
                                        <p>Recyclability:</p>
                                        <div class="w-full bg-gray-200 rounded-full">
                                            <div class="h-4 bg-blue-500 rounded-full flex items-center justify-center text-white" style="width: {{ $recycledDevice->recycled }}%;">
                                                {{ $recycledDevice->recycled }}/100
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endunless

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
    </div>
</x-app-layout>
