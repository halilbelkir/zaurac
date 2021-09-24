<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kullanıcı Düzenle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('users.update',$users->id)}}" method="post">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="name" value="Ad & Soyad" />
                            @if(!empty(old('name')))
                                <x-jet-input value="{{old('name')}}" id="name" name="name" type="text"  class="mt-1 block" wire:model.defer="users.name" autocomplete="name" placeholder="Ad & Soyad" />
                            @else
                                <x-jet-input value="{{$users->name}}" id="name" name="name" type="text"  class="mt-1 block" wire:model.defer="users.name" autocomplete="name" placeholder="Ad & Soyad" />
                            @endif
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="email" value="E-Mail" />
                            @if(!empty(old('email')))
                                <x-jet-input id="email" type="email" name="email" value="{{old('email')}}" class="mt-1 block" wire:model.defer="users.email" autocomplete="email" placeholder="E-Mail" />
                            @else
                                <x-jet-input id="email" type="email" name="email" value="{{$users->email}}" class="mt-1 block" wire:model.defer="users.email" autocomplete="email" placeholder="E-Mail" />
                            @endif
                            <x-jet-input-error for="email" class="mt-2" />
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

