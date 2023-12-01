<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Labels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- alert-success is a component I created to display a success message that may be sent from the controller.
            For example, when a label is deleted, a message like "Label Deleted Successfully" will be displayed -->
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <x-primary-button>
                <a href="{{ route('admin.labels.create') }}">Add a Label</a>
            </x-primary-button>

            @forelse ($labels as $label)
                <x-card>

                        <a href="{{ route('admin.labels.show', $label) }}" class="font-bold text-2xl">{{ $label->name }}</a>

                        <p class="mt-2 text-gray-700">
                            <span class="font-bold">ID:</span> {{ $label->id }}
                        </p>
                        <p class="mt-2 text-gray-700">
                            <span class="font-bold">Name:</span> {{ $label->name }}
                        </p>
                        <p class="mt-2 text-gray-700">
                            <span class="font-bold">Address:</span> {{ $label->address }}
                        </p>

                </x-card>
            @empty
                <p>No labels</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
