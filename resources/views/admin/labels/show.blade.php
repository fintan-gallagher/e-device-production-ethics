<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $label->name }} - Records by this Label
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Display publisher details -->

            <h3 class="font-bold text-2xl mb-4">Labels Details</h3>
            <p class="text-gray-700"><span class="font-bold">Name:</span> {{ $label->name }}</p>
            <p class="text-gray-700"><span class="font-bold">Address:</span> {{ $label->address }}</p>
            <p class="text-gray-700"><span class="font-bold">Email:</span> {{ $label->email }}</p>

            <!-- Display books for the publisher -->

            <h3 class="font-bold text-2xl mt-6 mb-4">Records by {{ $label->name }}</h3>

            @forelse ($records as $record)
                <x-card>
                     <a href="{{ route('admin.records.show', $record) }}" class="font-bold text-2xl">{{ $record->title }}</a>
                </x-card>
            @empty
                <p>No records for this label</p>
            @endforelse
            <x-primary-button><a href="{{ route('admin.labels.edit', $label) }}">Edit</a></x-primary-button>

                    <form action="{{ route('admin.labels.destroy', $label) }}" method="post">
                    @method('delete')
                    @csrf
                    <x-primary-button onclick="return confirm('Are you sure you want to delete this label?')">Delete</x-primary-button>
                    </form>
        </div>
    </div>
</x-app-layout>
