<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('records.update', $record) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <x-text-input
                        type="text"
                        name="title"
                        field="title"
                        placeholder="Title"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('title', $record->title)"
                    ></x-text-input>

                    <x-text-input
                        type="text"
                        name="artist"
                        field="artist"
                        placeholder="Artist..."
                        class="w-full mt-6"
                        :value="@old('artist', $record->artist)"
                    ></x-text-input>

                    <x-genre-dropdown
                        type="text"
                        name="genre"
                        field="genre"
                        placeholder="Genre..."
                        class="w-full mt-6"
                        :value="@old('genre', $record->genre)"
                    ></x-genre-dropdown>

                    <x-text-input
                        type="text"
                        name="isbn"
                        field="isbn"
                        placeholder="ISBN..."
                        class="w-full mt-6"
                        :value="@old('isbn', $record->isbn)"
                    ></x-text-input>

                    <x-date-input
                        type="text"
                        name="release_year"
                        field="release_year"
                        placeholder="Year of release..."
                        class="w-full mt-6"
                        :value="@old('release_year', $record->release_year)"
                    ></x-date-input>

                    <x-textarea
                        name="description"
                        rows="10"
                        field="description"
                        placeholder="Description..."
                        class="w-full mt-6"
                        :value="@old('description', $record->description)"
                    ></x-textarea>

                    <x-file-input
                        type="file"
                        name="record_cover"
                        placeholder="Record"
                        class="w-full mt-6"
                        field="record_cover"
                        :value="@old('record_cover', $record->record_cover)"
                    ></x-file-input>

                    <x-primary-button class="mt-6">Save Record</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
