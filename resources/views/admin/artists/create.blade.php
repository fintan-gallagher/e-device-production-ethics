<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Artist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.artists.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- Text Input field for record title --}}
                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="Name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('name')"></x-text-input>

                    {{-- Text Input field for artist name --}}
                    <x-text-input
                        type="text"
                        name="social_media"
                        field="social_media"
                        placeholder="Social Media..."
                        class="w-full mt-6"
                        :value="@old('social_media')"></x-text-input>

                    {{-- ENUM dropdown component for genres --}}
                    <x-text-input
                        type="text"
                        name="email"
                        field="email"
                        placeholder="Email..."
                        class="w-full mt-6"
                        :value="@old('email')"></x-text-input>

                    {{-- Text Input for ISBN --}}
                    <x-textarea
                        type="text"
                        name="bio"
                        field="bio"
                        placeholder="Biography..."
                        class="w-full mt-6"
                        :value="@old('bio')"></x-textarea>



                     <div class="mt-6">
                        <h1>Label</h1>
                        <x-select-label name="label_id" :labels="$labels" :selected="old('label_id')"/>
                    </div>

                    <div class="form-group">
                        <label for ="artists"> <strong>Records</strong> <br> </label>
                        @foreach ($records as $record)
                            <input type="checkbox" name="records[]" value="{{ $record->id }}">
                            {{ $record->title }}
                            @endforeach
                    </div>



                    <x-primary-button class="mt-6">Save Record</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
