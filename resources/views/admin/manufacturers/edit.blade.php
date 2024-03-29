<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Manufacturer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.manufacturers.update', $manufacturerWithDevices) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <p>Name</p>

                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="Name"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('name', $manufacturerWithDevices->name)"
                    ></x-text-input>

                    <p>Address</p>

                    <x-text-input
                        type="text"
                        name="address"
                        field="address"
                        placeholder="Address..."
                        class="w-full mt-6"
                        :value="@old('address', $manufacturerWithDevices->address)"
                    ></x-text-input>

                    <p>Email</p>
                    <x-text-input
                        type="text"
                        name="email"
                        field="email"
                        placeholder="Email..."
                        class="w-full mt-6"
                        :value="@old('email', $manufacturerWithDevices->email)"
                    ></x-text-input>

                    <p>Ethics Score</p>
                    <x-text-input
                        type="text"
                        name="ethics_score"
                        field="ethics_score"
                        placeholder="Ethics Score..."
                        class="w-full mt-6"
                        :value="@old('ethics_score', $manufacturerWithDevices->ethics_score)"
                    ></x-text-input>

                    <p>Biography</p>
                    <x-textarea
                        type="text"
                        name="bio"
                        field="bio"
                        placeholder="Biography..."
                        class="w-full mt-6"
                        :value="@old('bio', $manufacturerWithDevices->bio)"
                    ></x-textarea>



                    <p>Select Devices</p>
                        @foreach ($allDevices as $device)
                            <x-device-checkbox :device="$device" :checked="$manufacturerWithDevices->devices->contains($device)" />
                        @endforeach

                    <x-primary-button class="mt-6">Save Manufacturer</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
