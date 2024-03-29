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

                    <p>Model</p>

                    <x-text-input
                        type="text"
                        name="model"
                        field="model"
                        placeholder="Model"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('model', $device->model)"
                    ></x-text-input>

                    <p>Repairability</p>

                    <x-text-input
                        type="text"
                        name="repairability"
                        field="repairability"
                        placeholder="Repairability..."
                        class="w-full mt-6"
                        :value="@old('repairability', $device->repairability)"
                    ></x-text-input>

                    <x-genre-dropdown
                        type="text"
                        name="parts_availability"
                        field="parts_availability"
                        placeholder="Are Parts Available..."
                        class="w-full mt-6"
                        :value="@old('parts_availability', $device->parts_availability)"
                    ></x-genre-dropdown>

                    <p>Recycled?</p>

                    <x-text-input
                        type="text"
                        name="recycled"
                        field="recycled"
                        placeholder="Recyclability Score..."
                        class="w-full mt-6"
                        :value="@old('recycled', $device->recycled)"
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

                    <p>Price</p>

                    <x-text-input
                        type="text"
                        name="price"
                        field="price"
                        placeholder="Price..."
                        class="w-full mt-6"
                        :value="@old('price', $device->price)"
                    ></x-text-input>

                     <div class="mt-6">
                        <x-select-manufacturer name="manufacturer_id" :manufacturers="$manufacturers" :selected="old('manufacturer_id')"/>
                    </div>




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


                        <h2>Remove Repair Guides</h2>

                        @foreach($device->repairGuides as $repairGuide)
                        <div>
                            <input type="checkbox" id="remove_repair_guide_{{ $repairGuide->id }}" name="remove_repair_guides[]" value="{{ $repairGuide->id }}">
                            <label for="remove_repair_guide_{{ $repairGuide->id }}">{{ $repairGuide->guide }}</label>
                        </div>
                        @endforeach

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
