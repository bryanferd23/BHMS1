<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Payment') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('payment.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" value="{{$boarder->email}}" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" class="block w-full mt-1" type="text" name="amount" value="{{$payment->amount}}" required />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
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
