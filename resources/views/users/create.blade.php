<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kullanıcı Ekle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">
                
                <form action="{{route('users.store')}}" method="post">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="name" value="Ad & Soyad" />
                            <x-jet-input id="name" name="name" type="text" value="{{old('name')}}" class="mt-1 block" wire:model.defer="users.name" autocomplete="name" placeholder="Ad & Soyad" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="email" value="E-Mail" />
                            <x-jet-input id="email" type="email" name="email" value="{{old('email')}}" class="mt-1 block" wire:model.defer="users.email" autocomplete="email" placeholder="E-Mail" />
                            <x-jet-input-error for="email" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="password" value="Şifre" />
                            <x-jet-input id="password" type="password" name="password" value="{{old('password')}}"  class="mt-1 block" wire:model.defer="users.password" autocomplete="password" placeholder="Şifre" />
                            <x-jet-input-error for="password" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="password_confirmation" value="Şifre Tekrar" />
                            <x-jet-input id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}" type="password" class="mt-1 block"  autocomplete="password_confirmation" placeholder="Şifre Tekrar" />
                            <x-jet-input-error for="password_confirmation" class="mt-2" />
                        </div>
                    </div>

                    <x-jet-button class="float-right">
                        {{ __('Kaydet') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

