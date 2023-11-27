<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td rowspan="6">
                                <!-- use the asset function, access the file $record->record_cover in the folder storage/images -->
                                <img src="{{ asset($record->record_cover) }}"
                                alt="{{ $record->title }}" width="100">
                            </td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Title</td>
                                <td>{{ $record->title }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Artist</td>
                                <td>{{ $record->artist }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold">Description</td>
                                <td>{{ $record->description }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Genre</td>
                                <td>{{ $record->genre }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Release Date</td>
                                <td>{{ $record->release_year }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold ">Label</td>
                                <td>{{ $record->label->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold ">ISBN</td>
                                <td>{{ $record->isbn }}</td>
                            </tr>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
