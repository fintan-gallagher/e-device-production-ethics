<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.artists.update', $artist) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <p>Name</p>

                    <x-text-input type="text" name="name" field="name" placeholder="Name..." class="w-full"
                        autocomplete="off" :value="@old('title', $artist->name)"></x-text-input>

                    <p>Social Media</p>

                    <x-text-input type="text" name="social_media" field="social_media" placeholder="Social Media..."
                        class="w-full mt-6" :value="@old('artist', $artist->social_media)"></x-text-input>

                    <x-text-input type="text" name="email" field="email" placeholder="Email..."
                        class="w-full mt-6" :value="@old('email', $artist->email)"></x-text-input>

                    <p>ISBN</p>

                    <x-textarea type="text" name="bio" field="bio" placeholder="Biography..."
                        class="w-full mt-6" :value="@old('bio', $artist->bio)"></x-textarea>

                    <div class="mt-6">
                        <h1>Label</h1>
                        <x-select-label name="label_id" :labels="$labels" :selected="old('label_id')" />
                    </div>

                    <div class="form-group">
                        <label for="artists"> <strong>Records</strong> <br> </label>
                        @foreach ($records as $record)
                            <input type="checkbox" name="records[]" value="{{ $record->id }}"
                                {{ in_array($record->id, $artist->records->pluck('id')->toArray()) ? 'checked' : '' }}>
                            {{ $record->title }}
                        @endforeach
                    </div>


                    <x-primary-button class="mt-6">Save Artist</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
