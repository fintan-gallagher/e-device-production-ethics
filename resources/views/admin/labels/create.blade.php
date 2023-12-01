<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Label') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.labels.store') }}" method="post" enctype="multipart/form-data">
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
                        name="address"
                        field="address"
                        placeholder="Address..."
                        class="w-full mt-6"
                        :value="@old('address')"></x-text-input>

                        <x-text-input
                        type="text"
                        name="email"
                        field="email"
                        placeholder="Email..."
                        class="w-full mt-6"
                        :value="@old('email')"></x-text-input>

                       <p>Select Records</p>
                        @foreach ($allRecords as $record)
                            <x-record-checkbox :record="$record" :checked="false" />
                        @endforeach



                    <x-primary-button class="mt-6">Save Label</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
