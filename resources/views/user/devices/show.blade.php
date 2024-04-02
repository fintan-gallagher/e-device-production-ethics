<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
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
                            <h1 class="font-bold">Are Parts Available?</h2>
                                <p>{{$device->parts_availability}}</p>
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
                                                    <a href="{{ route('user.manufacturers.show', $device->manufacturer->id) }}" class="text-blue-500 hover:underline" >
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
                    <h3><a href="{{ $repairguide->guide }}" target="_blank">{{ $repairguide->guide }}</a></h3>
                </x-card>
                @empty
                <p>No repair guides for this manufacturer</p>
                @endforelse



            </div>

        </div>
    </div>
</x-app-layout>
