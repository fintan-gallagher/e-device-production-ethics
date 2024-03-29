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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td rowspan="6">
                                    <!-- use the asset function, access the file $device->device_cover in the folder storage/images -->
                                    <img src="{{ asset($device->device_cover) }}" alt="{{ $device->model }}" width="100">
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Model</td>
                                <td>{{ $device->model }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold">Repairability</td>
                                <td>
                                    <div class="progress-bar" style="width: 100%; height: 20px; border: 1px solid #000;">
                                        <div style="width: {{ $device->repairability }}%; height: 100%; background-color: #00f;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold">Recyclability</td>
                                <td>
                                    <div class="progress-bar" style="width: 100%; height: 20px; border: 1px solid #000;">
                                        <div style="width: {{ $device->recycled }}%; height: 100%; background-color: #00f;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Are Parts Available?</td>
                                <td>{{ $device->parts_availability }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Release Date</td>
                                <td>{{ $device->release_year }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold">Manufacturer</td>
                                <td>{{ $device->manufacturer ? $device->manufacturer->name : 'No Manufacturer' }}</td>
                            </tr>

                            <tr>
                                <td class="font-bold ">Price</td>
                                <td>{{ $device->price }}</td>
                            </tr>
                    </table>



                    <h3 class="font-bold text-2xl mt-6 mb-4">Repair Guides for {{ $device->model }}</h3>

                    @forelse ($repairguides as $repairguide)
                    <x-card>
                        <h3><a href="{{ $repairguide->guide }}" target="_blank">{{ $repairguide->guide }}</a></h3>
                    </x-card>
                    @empty
                    <p>No repair guides for this manufacturer</p>
                    @endforelse


                    <x-primary-button><a href="{{ route('admin.devices.edit', $device) }}">Edit</a></x-primary-button>

                    <form action="{{ route('admin.devices.destroy', $device) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-primary-button onclick="return confirm('Are you sure you want to delete this device?')">Delete</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
