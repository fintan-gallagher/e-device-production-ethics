<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Label') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.labels.update', $labelWithRecords) }}" method="post" enctype="multipart/form-data">
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
                        :value="@old('name', $labelWithRecords->name)"
                    ></x-text-input>

                    <p>Address</p>

                    <x-text-input
                        type="text"
                        name="address"
                        field="address"
                        placeholder="Address..."
                        class="w-full mt-6"
                        :value="@old('address', $labelWithRecords->address)"
                    ></x-text-input>

                    <p>Email</p>
                    <x-text-input
                        type="text"
                        name="email"
                        field="email"
                        placeholder="Email..."
                        class="w-full mt-6"
                        :value="@old('email', $labelWithRecords->email)"
                    ></x-text-input>

                    <p>Select Records</p>
                        @foreach ($allRecords as $record)
                            <x-record-checkbox :record="$record" :checked="$labelWithRecords->records->contains($record)" />
                        @endforeach

                    <x-primary-button class="mt-6">Save Label</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
