<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ödül Ekle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('awards.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 mb-3">
                        <div>
                            <x-jet-label for="title" value="Başlık" />
                            <x-jet-input id="title" name="title" type="text" value="{{old('title')}}" class="mt-1 block"  placeholder="Başlık" />
                            <x-jet-input-error for="title" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="content" value="İçerik" />
                            <textarea id="content" name="content" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="İçerik" rows="2">{{old('content')}}</textarea>
                            <x-jet-input-error for="content" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="link" value="Link" />
                            <x-jet-input id="link" name="link" type="url" value="{{old('link')}}" class="mt-1 block"  placeholder="Link" />
                            <x-jet-input-error for="link" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-jet-label for="image" value="Resim" />
                        <x-jet-input id="image" name="image" type="file" value="{{old('image')}}" class="mt-1 block"  placeholder="Resim"  />
                        <x-jet-input-error for="image" class="mt-2" />
                    </div>

                    <x-jet-button class="float-right">
                        {{ __('Kaydet') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

