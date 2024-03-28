<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Device') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.devices.update', $device) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <p>Title</p>

                    <x-text-input
                        type="text"
                        name="title"
                        field="title"
                        placeholder="Title"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('title', $device->title)"
                    ></x-text-input>

                    <p>Artist</p>

                    <x-text-input
                        type="text"
                        name="artist"
                        field="artist"
                        placeholder="Artist..."
                        class="w-full mt-6"
                        :value="@old('artist', $device->artist)"
                    ></x-text-input>

                    <x-genre-dropdown
                        type="text"
                        name="genre"
                        field="genre"
                        placeholder="Genre..."
                        class="w-full mt-6"
                        :value="@old('genre', $device->genre)"
                    ></x-genre-dropdown>

                    <p>ISBN</p>

                    <x-text-input
                        type="text"
                        name="isbn"
                        field="isbn"
                        placeholder="ISBN..."
                        class="w-full mt-6"
                        :value="@old('isbn', $device->isbn)"
                    ></x-text-input>

                    <p>Release Date</p>

                    <x-date-input
                        type="text"
                        name="release_year"
                        field="release_year"
                        placeholder="Year of release..."
                        class="w-full mt-6"
                        :value="@old('release_year', $device->release_year)"
                    ></x-date-input>

                    <p>Description</p>

                    <x-textarea
                        name="description"
                        rows="10"
                        field="description"
                        placeholder="Description..."
                        class="w-full mt-6"
                        :value="@old('description', $device->description)"
                    ></x-textarea>

                     <div class="mt-6">
                        <x-select-manufacturer name="manufacturer_id" :manufacturers="$manufacturers" :selected="old('manufacturer_id')"/>
                    </div>

                    <x-file-input
                        type="file"
                        name="device_cover"
                        placeholder="Device"
                        class="w-full mt-6"
                        field="device_cover"
                        :value="@old('device_cover', $device->device_cover)"
                    ></x-file-input>

                    <x-primary-button class="mt-6">Save Device</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
