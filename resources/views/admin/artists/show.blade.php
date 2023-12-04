<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $artist->name }} - Records by this artist
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Display publisher details -->

            <h3 class="font-bold text-2xl mb-4">artist Details</h3>
            <p class="text-gray-700"><span class="font-bold">ID:</span> {{ $artist->id }}</p>
            <p class="text-gray-700"><span class="font-bold">Name:</span> {{ $artist->name }}</p>
            <p class="text-gray-700"><span class="font-bold">Social Media:</span> {{ $artist->social_media }}</p>
            <p class="text-gray-700"><span class="font-bold">Email:</span> {{ $artist->email }}</p>

            <!-- Display records for the publisher -->

            <h3 class="font-bold text-2xl mt-6 mb-4">Records by {{ $artist->name }}</h3>

            @forelse ($records as $record)
                <x-card>
                     <a href="{{ route('admin.records.show', $record) }}" class="font-bold text-2xl">{{ $record->title }}</a>

                </x-card>
            @empty
                <p>No records for this artist</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
