<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Add Boarder') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('boarder.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <div class="mb-6">
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" class="block w-full mt-1" type="text" name="address" :value="old('address')" required autofocus />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div class="mb-6">
                                <x-input-label for="contact_number" :value="__('Contact Number')" />
                                <x-text-input id="contact_number" class="block w-full mt-1" type="text" name="contact_number" :value="old('contact_number')" required />
                                <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                            </div>
                        </div>
                        <x-primary-button>
                            {{ __('Add Boarder') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
