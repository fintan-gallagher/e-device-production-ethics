<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Devices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>


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
                    @forelse ($devices as $device)
                        <tr>
                            <td class="px-4 py-2">
                                <a href="{{ route('user.devices.show', $device) }}">{{ $device->title }}</a>
                            </td>
                            <td class="px-4 py-2">{{ $device->artist }}</td>
                            <td class="px-4 py-2">{{ $device->genre }}</td>
                            <td class="px-4 py-2">{{ $device->description }}</td>
                            <td class="px-4 py-2">{{ $device->manufacturer->name }}</td>
                            <td class="px-4 py-2">
                                @if ($device->device_cover)
                                    <img src="{{ asset($device->device_cover) }}" alt="{{ $device->title }}" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-2" colspan="4">No devices</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- <div class="pagination-links">
            {{ $devices->links() }}
        </div> --}}
    </div>
</x-app-layout>
