<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Manufacturers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <div class="flex flex-wrap justify-around">
                @forelse ($manufacturers as $manufacturer)
                <a href="{{ route('user.manufacturers.show', $manufacturer) }}" class="mt-4 mb-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 md:object-cover md:w-1/2 md:h-48">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{ asset($manufacturer->manufacturer_img) }}" alt="{{ $manufacturer->name }}">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $manufacturer->name }}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            <span class="font-bold">Address:</span> {{ $manufacturer->address }}
                        </p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            <span class="font-bold">Ethics Score:</span> {{ $manufacturer->ethics_score }}
                        </p>
                    </div>
                </a>
                @empty
                <p>No manufacturers</p>
                @endforelse
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
        </div>
    </div>
</x-app-layout>
