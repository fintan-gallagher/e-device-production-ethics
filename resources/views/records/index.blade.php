
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('records.create') }}" class="btn-link btn-lg mb-2">Add a Record</a>
            @forelse ($records as $record)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                    <a href="{{ route('records.show', $record) }}">{{ $record->title }}</a>
                    </h2>
                    <p class="mt-2">
                        {{ $record->genre }}
                        {{$record->description}}
                        @if ($record->record_cover)
                        <img src="{{ asset($record->record_cover) }}"
                        alt="{{ $record->title }}" width="100">
                    @else
                        No Image
                    @endif
                    </p>

                </div>
            @empty
            <p>No records</p>
            @endforelse

        </div>
    </div>
</x-app-layout>

