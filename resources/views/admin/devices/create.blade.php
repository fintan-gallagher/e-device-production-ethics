<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Device') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.devices.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- Text Input field for device model --}}
                    <x-text-input
                        type="text"
                        name="model"
                        field="model"
                        placeholder="Model"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('model')"></x-text-input>

                    {{-- Text Input field for artist name --}}
                    <x-text-input
                        type="text"
                        name="repairability"
                        field="repairability"
                        placeholder="Repairable..."
                        class="w-full mt-6"
                        :value="@old('repairability')"></x-text-input>

                    {{-- ENUM dropdown component for genres --}}
                    <x-genre-dropdown
                        type="text"
                        name="parts_availability"
                        field="parts_availability"
                        placeholder="Are Parts Available..."
                        class="w-full mt-6"
                        :value="@old('parts_availability')"></x-genre-dropdown>

                    {{-- Text Input for ISBN --}}
                    <x-text-input
                        type="text"
                        name="recycled"
                        field="recycled"
                        placeholder="Recycled..."
                        class="w-full mt-6"
                        :value="@old('recycled')"></x-text-input>

                    {{-- Calendar component for date input --}}
                    <x-date-input
                        type="text"
                        name="release_year"
                        field="release_year"
                        placeholder="Year of release..."
                        class="w-full mt-6"
                        :value="@old('release_year')"></x-date-input>

                    {{-- Large text area component for device description --}}
                    <x-text-input
                        type="text"
                        name="price"
                        field="price"
                        placeholder="Price..."
                        class="w-full mt-6"
                        :value="@old('price')"></x-text-input>

                     <div class="mt-6">
                        <x-select-manufacturer name="manufacturer_id" :manufacturers="$manufacturers" :selected="old('manufacturer_id')"/>
                    </div>



                    {{-- File input for images --}}
                    <x-file-input
                        type="file"
                        name="device_cover"
                        placeholder="Device"
                        class="w-full mt-6"
                        field="device_cover"
                        :value="@old('device_cover')">>
                    </x-file-input>

                    <div id="repairGuides">
                            <!-- This is where new repair guide input fields will be added -->
                        </div>

                        <x-primary-button type="button" id="addRepairGuide">Add Repair Guide</x-primary-button>

                        <script>
                            document.getElementById('addRepairGuide').addEventListener('click', function() {
                                var repairGuides = document.getElementById('repairGuides');
                                var newInput = document.createElement('input');
                                newInput.type = 'text';
                                newInput.name = 'new_repair_guides[]';
                                newInput.placeholder = 'Repair Guide URL';
                                repairGuides.appendChild(newInput);
                            });

                        </script>

                    <x-primary-button class="mt-6">Save Device</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
