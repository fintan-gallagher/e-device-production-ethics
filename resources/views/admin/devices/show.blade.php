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
                                <img src="{{ asset($device->device_cover) }}"
                                alt="{{ $device->title }}" width="100">
                            </td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Title</td>
                                <td>{{ $device->title }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold">Description</td>
                                <td>{{ $device->description }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Genre</td>
                                <td>{{ $device->genre }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Release Date</td>
                                <td>{{ $device->release_year }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold">Label</td>
                                <td>{{ $device->manufacturer->name }}</td>
                            </tr>

                            <tr>
                                <td class="font-bold ">ISBN</td>
                                <td>{{ $device->isbn }}</td>
                            </tr>
                        </table>




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
