<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Boarder') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('boarder.update', $boarder->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="prev_url" value="{{url()->previous()}}" hidden>
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" value="{{$boarder->name}}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" value="{{$boarder->email}}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <div class="mb-6">
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" class="block w-full mt-1" type="text" name="address" value="{{$boarder->address}}" required autofocus />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div class="mb-6">
                                <x-input-label for="contact_number" :value="__('Contact Number')" />
                                <x-text-input id="contact_number" class="block w-full mt-1" type="text" name="contact_number" value="{{$boarder->contact_number}}" required />
                                <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <input
                            @if ($boarder->status == 0)
                                @checked(true)
                            @endif  
                            id="default-radio-1" type="radio" value="0" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-1" class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">Inactive</label>

                            <input 
                            @if ($boarder->status == 1)
                                @checked(true)
                            @endif  
                            id="default-radio-2" type="radio" value="1" name="status" class="w-4 h-4 ml-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-2" class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">Active</label>
                        </div>

                        <x-primary-button>
                            {{ __('Update') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
