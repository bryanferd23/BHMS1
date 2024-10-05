<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Boarders') }}
            </h2>
            <a href="{{ route('boarder.create') }}" class="px-3 py-1 text-xs text-white bg-gray-800 rounded-lg">
                + ADD
            </a>
        </div>
    </x-slot>

    @if (session('status'))
        <div class="p-4 mb-4 text-sm text-center text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <form class="max-w-md mx-auto mb-4" method="GET" action="{{ route('boarder.search') }}">
                @csrf
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input value="{{ request('search') }}" type="search" name="search" id="search" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">GO</button>
                </div>
            </form>


            @if (count($boarders) == 0)
                <div class="flex justify-center py-4 bg-white shadow-md sm:rounded-lg">
                    <div>No data found</div>
                </div>
            @else
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-5">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-5">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-5">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-5">
                                Contact Number
                            </th>
                            <th scope="col" class="px-6 py-5">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-5 text-blue-700">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($boarders as $boarder)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$boarder->name}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$boarder->email}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$boarder->address}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$boarder->contact_number}}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($boarder->status == 1)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Active</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex space-x-4">
                                        <div>
                                            <a href="{{ route('boarder.edit', $boarder->id) }}" class="bg-gray-800 hover:bg-gray-900 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-900">Edit</a>
                                        </div>
                                        <div>
                                            <form action="{{route('boarder.destroy', $boarder->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" data-single-click>Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{$boarders->appends(request()->query())->links()}}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
