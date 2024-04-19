<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Manufacturer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.manufacturers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- Text Input field for device title --}}
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

                        <p>Longitude</p>

                    <x-text-input
                        type="text"
                        name="lng"
                        field="lng"
                        placeholder="Longitude..."
                        class="w-full mt-6"
                        :value="@old('lng', $manufacturerWithDevices->lng)"
                    ></x-text-input>

                    <p>Latitude</p>

                    <x-text-input
                        type="text"
                        name="lat"
                        field="lat"
                        placeholder="Latitude..."
                        class="w-full mt-6"
                        :value="@old('lat', $manufacturerWithDevices->lat)"
                    ></x-text-input>

                        <x-text-input
                        type="text"
                        name="email"
                        field="email"
                        placeholder="Email..."
                        class="w-full mt-6"
                        :value="@old('email')"></x-text-input>

                        <x-text-input
                        type="text"
                        name="ethics_score"
                        field="ethics_score"
                        placeholder="Ethics Score..."
                        class="w-full mt-6"
                        :value="@old('ethics_score')"></x-text-input>

                        <x-textarea
                        type="text"
                        name="bio"
                        field="bio"
                        placeholder="Biography..."
                        class="w-full mt-6"
                        :value="@old('bio')"></x-textarea>

                       <p>Select Devices</p>
                        @foreach ($allDevices as $device)
                            <x-device-checkbox :device="$device" :checked="false" />
                        @endforeach

                        <x-file-input type="file" name="manufacturer_img" placeholder="Manufacturer" class="w-full mt-6" field="manufacturer_img" :value="@old('manufacturer_img')">>
                    </x-file-input>



                    <x-primary-button class="mt-6">Save Manufacturer</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
