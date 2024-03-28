<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Manufacturers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- alert-success is a component I created to display a success message that may be sent from the controller.
            For example, when a manufacturer is deleted, a message like "Manufacturer Deleted Successfully" will be displayed -->
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <x-primary-button>
                <a href="{{ route('admin.manufacturers.create') }}">Add a Manufacturer</a>
            </x-primary-button>

            @forelse ($manufacturers as $manufacturer)
                <x-card>

                        <a href="{{ route('admin.manufacturers.show', $manufacturer) }}" class="font-bold text-2xl">{{ $manufacturer->name }}</a>

                        <p class="mt-2 text-gray-700">
                            <span class="font-bold">ID:</span> {{ $manufacturer->id }}
                        </p>
                        <p class="mt-2 text-gray-700">
                            <span class="font-bold">Name:</span> {{ $manufacturer->name }}
                        </p>
                        <p class="mt-2 text-gray-700">
                            <span class="font-bold">Address:</span> {{ $manufacturer->address }}
                        </p>

                </x-card>
            @empty
                <p>No manufacturers</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
