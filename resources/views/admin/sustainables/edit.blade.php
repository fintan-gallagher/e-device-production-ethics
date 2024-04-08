<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Manufacturer Info') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.sustainables.update', $sustainable) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <p>Name</p>

                    <x-text-input type="text" name="heading" field="heading" placeholder="Heading" class="w-full" autocomplete="off" :value="@old('heading', $sustainable->heading)"></x-text-input>


                    <p>Biography</p>
                    <textarea id="editor" type="text" name="comments" field="comments" placeholder="Article..." class="w-full mt-6">{{ old('comments', $sustainable->comments) }}</textarea>

                    <script>
                        CKEDITOR.replace('editor');

                    </script>


                    <x-primary-button class="mt-6">Save Sustainable</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
