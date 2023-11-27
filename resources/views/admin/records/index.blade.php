<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <x-primary-button>
                <a href="{{ route('admin.records.create') }}">Add a Record</a>
            </x-primary-button>

            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Artist</th>
                        <th class="px-4 py-2">Genre</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Label</th>
                        <th class="px-4 py-2">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                        <tr>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.records.show', $record) }}">{{ $record->title }}</a>
                            </td>
                            <td class="px-4 py-2">{{ $record->artist }}</td>
                            <td class="px-4 py-2">{{ $record->genre }}</td>
                            <td class="px-4 py-2">{{ $record->description }}</td>
                            <td class="px-4 py-2">{{ $record->label->name }}</td>
                            <td class="px-4 py-2">
                                @if ($record->record_cover)
                                    <img src="{{ asset($record->record_cover) }}" alt="{{ $record->title }}" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-2" colspan="4">No records</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- <div class="pagination-links">
            {{ $records->links() }}
        </div> --}}
    </div>
</x-app-layout>
