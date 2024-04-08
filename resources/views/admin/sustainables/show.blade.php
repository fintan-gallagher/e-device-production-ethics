<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $sustainable->manufacturer->name }}
        </h2>
    </x-slot>

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>




            <!--Title-->


            <!--image-->
            <div class="container w-full max-w-6xl mx-auto bg-cover mt-8 rounded" style="background-image:url('{{ asset($sustainable->manufacturer->manufacturer_img) }}'); background-position: center; background-size: contain; background-repeat: no-repeat; height: 53.8vh;"></div>

            <!--Container-->
            <div class="container max-w-5xl mx-auto -mt-32">

                <div class="mx-0 sm:mx-6">

                    <div class="bg-white w-full p-8 md:p-24 text-xl md:text-2xl text-gray-800 leading-normal">
                        <div class="text-center pt-16 md:pt-32">
                            <h1 class="font-bold break-normal text-3xl md:text-5xl">{{ $sustainable->heading }}</h1>
                            <h1 class="mt-3 font-bold">Ethics Score</h2>
                                <div class="relative h-6 bg-gray-200 rounded-lg overflow-hidden">
                                    <div class="h-full bg-blue-500" style="width: {{ $sustainable->manufacturer->ethics_score }}%;"></div>
                                    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                        {{ $sustainable->manufacturer->ethics_score }}/100
                                    </div>
                                </div>
                        </div>

                        <p class="py-6">{!! html_entity_decode($sustainable->comments) !!}</p>




                    </div>





                </div>

            </div>


            <div class="bg-gray-200 my-5">
                <div class="ml-8 pt-16 md:pt-32">
                    <h1 class="font-bold break-normal text-1xl md:text-2xl">Other Manufacturers:</h1>
                </div>
                <div class="container w-full max-w-6xl mx-auto px-2 py-8">
                    <div class="flex flex-wrap -mx-2">
                        @foreach ($manufacturers as $manufacturer)
                        <div class="w-full md:w-1/3 px-2 pb-12">
                            <div class="h-full bg-white rounded overflow-hidden shadow-md hover:shadow-lg relative smooth">
                                <a href="{{ route('admin.manufacturers.show', $manufacturer) }}" class="no-underline hover:no-underline">
                                    <img src="{{ asset($manufacturer->manufacturer_img) }}" class="h-48 w-full rounded-t shadow-lg">
                                    <div class="p-6 h-auto md:h-48">
                                        <p class="text-gray-600 text-xs md:text-sm">MANUFACTURER</p>
                                        <div class="font-bold text-xl text-gray-900">{{ $manufacturer->name }}</div>
                                        <p class="text-gray-800 text-base mb-5">
                                            {{ $manufacturer->bio }}
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-between inset-x-0 bottom-0 p-6">
                                        <p class="text-gray-600 text-xs md:text-sm">Ethics Score: {{ $manufacturer->ethics_score }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


            </div>

            <div class="container max-w-5xl my-10 mx-auto ">
                <div class="mx-0 sm:mx-6">
                    <!--Subscribe-->
                    <div class="container font-sans bg-gray-200 rounded mt-8 p-4 md:p-24 text-center">
                        <h2 class="font-bold break-normal text-2xl md:text-4xl">Subscribe to EthiTech</h2>
                        <h3 class="font-bold break-normal font-normal text-gray-600 text-base md:text-xl">Get the latest posts delivered right to your inbox</h3>
                        <div class="w-full text-center pt-4">
                            <form action="#">
                                <div class="max-w-sm mx-auto p-1 pr-0 flex flex-wrap items-center">
                                    <input type="email" placeholder="youremail@example.com" class="flex-1 appearance-none rounded shadow p-3 text-gray-600 mr-2 focus:outline-none">
                                    <button type="submit" class="flex-1 mt-4 md:mt-0 block md:inline-block appearance-none bg-gray-500 text-white text-base font-semibold tracking-wider uppercase py-4 rounded shadow hover:bg-blue-400">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Subscribe-->
                </div>
            </div>

            <x-primary-button class="mb-2">
                <a href="{{ route('admin.manufacturers.show', $sustainable->manufacturer_id) }}">Back to Manufacturer</a>
            </x-primary-button>

            <x-primary-button class="mb-2"><a href="{{ route('admin.sustainables.edit', $sustainable) }}">Edit</a></x-primary-button>

            <form action="{{ route('admin.sustainables.destroy', $sustainable) }}" method="post">
                @method('delete')
                @csrf
                <x-primary-button onclick="return confirm('Are you sure you want to delete this sustainable?')">Delete</x-primary-button>
            </form>
        </div>

    </div>
    </div>
</x-app-layout>
