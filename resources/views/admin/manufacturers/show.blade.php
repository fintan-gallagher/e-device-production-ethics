<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $manufacturer->name }} - Devices by this Manufacturer
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Display publisher details -->

            <h3 class="font-bold text-2xl mb-4">Manufacturers Details</h3>
            <p class="text-gray-700"><span class="font-bold">Name:</span> {{ $manufacturer->name }}</p>
            <p class="text-gray-700"><span class="font-bold">Address:</span> {{ $manufacturer->address }}</p>
            <p class="text-gray-700"><span class="font-bold">Email:</span> {{ $manufacturer->email }}</p>

            <!-- Display books for the publisher -->

            <h3 class="font-bold text-2xl mt-6 mb-4">Devices by {{ $manufacturer->name }}</h3>

            @forelse ($devices as $device)
                <x-card>
                     <a href="{{ route('admin.devices.show', $device) }}" class="font-bold text-2xl">{{ $device->title }}</a>
                </x-card>
            @empty
                <p>No devices for this manufacturer</p>
            @endforelse
            <x-primary-button><a href="{{ route('admin.manufacturers.edit', $manufacturer) }}">Edit</a></x-primary-button>

                    <form action="{{ route('admin.manufacturers.destroy', $manufacturer) }}" method="post">
                    @method('delete')
                    @csrf
                    <x-primary-button onclick="return confirm('Are you sure you want to delete this manufacturer?')">Delete</x-primary-button>
                    </form>
        </div>
    </div>
</x-app-layout>
