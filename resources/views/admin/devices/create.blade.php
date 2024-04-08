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
                    <x-text-input type="text" name="model" field="model" placeholder="Model" class="w-full" autocomplete="off" :value="@old('model')"></x-text-input>

                    {{-- Text Input field for artist name --}}
                    <x-text-input type="text" name="repairability" field="repairability" placeholder="Repairable..." class="w-full mt-6" :value="@old('repairability')"></x-text-input>

                    {{-- ENUM dropdown component for genres --}}
                    <x-genre-dropdown type="text" name="parts_availability" field="parts_availability" placeholder="Are Parts Available..." class="w-full mt-6" :value="@old('parts_availability')"></x-genre-dropdown>

                    {{-- Text Input for ISBN --}}
                    <x-text-input type="text" name="recycled" field="recycled" placeholder="Recycled..." class="w-full mt-6" :value="@old('recycled')"></x-text-input>

                    {{-- Calendar component for date input --}}
                    <x-date-input type="text" name="release_year" field="release_year" placeholder="Year of release..." class="w-full mt-6" :value="@old('release_year')"></x-date-input>

                    {{-- Large text area component for device description --}}
                    <x-text-input type="text" name="price" field="price" placeholder="Price..." class="w-full mt-6" :value="@old('price')"></x-text-input>

                    <div class="mt-6">
                        <x-select-manufacturer name="manufacturer_id" :manufacturers="$manufacturers" :selected="old('manufacturer_id')" />
                    </div>



                    {{-- File input for images --}}
                    <x-file-input type="file" name="device_cover" placeholder="Device" class="w-full mt-6" field="device_cover" :value="@old('device_cover')">>
                    </x-file-input>

                    <div id="repairGuides">
                        <!-- This is where new repair guide input fields will be added -->
                    </div>

                    <x-primary-button type="button" id="addRepairGuide">Add Repair Guide</x-primary-button>

                    <script>
                        document.getElementById('addRepairGuide').addEventListener('click', function() {
                            var repairGuides = document.getElementById('repairGuides');

                             // New input for Repair Guide Heading
                            var headingInput = document.createElement('input');
                            headingInput.type = 'text';
                            headingInput.name = 'new_repair_guide_headings[]';
                            headingInput.placeholder = 'Repair Guide Heading';
                            repairGuides.appendChild(headingInput);

                            // New input for Repair Guide URL
                            var urlInput = document.createElement('input');
                            urlInput.type = 'text';
                            urlInput.name = 'new_repair_guides[]';
                            urlInput.placeholder = 'Repair Guide URL';
                            repairGuides.appendChild(urlInput);
                           });

                    </script>

                    <div id="parts">
                        <!-- This is where new part input fields will be added -->
                    </div>

                    <x-primary-button type="button" id="addParts">Add Part</x-primary-button>

                    <script>
                        document.getElementById('addParts').addEventListener('click', function() {
                            var parts = document.getElementById('parts');

                            // Part Heading input
                            var headingInput = document.createElement('input');
                            headingInput.type = 'text';
                            headingInput.name = 'new_parts_headings[]';
                            headingInput.placeholder = 'Part Heading';
                            parts.appendChild(headingInput);

                            // Part URL input
                            var urlInput = document.createElement('input');
                            urlInput.type = 'text';
                            urlInput.name = 'new_parts_urls[]';
                            urlInput.placeholder = 'Part URL';
                            parts.appendChild(urlInput);

                            // OEM input label
                            var oemInputDiv = document.createElement('div');
                            oemInputDiv.style.display = 'flex';
                            oemInputDiv.style.flexDirection = 'column';
                            var oemInputLabel = document.createElement('label');
                            oemInputLabel.textContent = 'Official Part:    ';
                            oemInputDiv.appendChild(oemInputLabel);

                            // OEM input
                            var oemInput = document.createElement('select');
                            oemInput.name = 'new_parts_oems[]';
                            oemInput.style.width = '200px';
                            var optionYes = document.createElement('option');
                            optionYes.value = 'Yes';
                            optionYes.text = 'Yes';
                            var optionNo = document.createElement('option');
                            optionNo.value = 'No';
                            optionNo.text = 'No';
                            oemInput.appendChild(optionYes);
                            oemInput.appendChild(optionNo);
                            oemInputDiv.appendChild(oemInput);
                            parts.appendChild(oemInputDiv);

                            // Admin Rec input label
                            var adminRecInputDiv = document.createElement('div');
                            adminRecInputDiv.style.display = 'flex';
                            adminRecInputDiv.style.flexDirection = 'column';
                            var adminRecInputLabel = document.createElement('label');
                            adminRecInputLabel.textContent = 'Admin Recommends: ';
                            adminRecInputDiv.appendChild(adminRecInputLabel);

                            // Admin Rec input
                            var adminRecInput = document.createElement('select');
                            adminRecInput.name = 'new_parts_admin_recs[]';
                            adminRecInput.style.width = '200px';
                            var optionYes = document.createElement('option');
                            optionYes.value = 'Yes';
                            optionYes.text = 'Yes';
                            var optionNo = document.createElement('option');
                            optionNo.value = 'No';
                            optionNo.text = 'No';
                            adminRecInput.appendChild(optionYes);
                            adminRecInput.appendChild(optionNo);
                            adminRecInputDiv.appendChild(adminRecInput);
                            parts.appendChild(adminRecInputDiv);
                        });

                    </script>

                    <x-primary-button class="mt-6">Save Device</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
