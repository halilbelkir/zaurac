<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Galeri Ekle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('gallery.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 mb-5">
                        <div>
                            <x-jet-label for="category_name" value="Kategori Adı" />
                            <x-jet-input id="category_name" name="category_name" type="text" value="{{old('category_name')}}" class="mt-1 block"  placeholder="Kategori Adı" />
                            <x-jet-input-error for="category_name" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="youtube_link" value="Youtube Linkleri (Her linki virgül ile ayırınız.)" />
                            <textarea id="youtube_link" name="youtube_link" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="Youtube Linkleri (Her linki virgül ile ayırınız.)" rows="2">{{old('youtube_link')}}</textarea>
                            <x-jet-input-error for="youtube_link" class="mt-2" />
                        </div>

                    </div>

                    <div>
                        <x-jet-label for="images" value="Resimler" />
                        <x-jet-input id="images" name="images[]" type="file" value="{{old('images')}}" class="mt-1 block"  placeholder="Resimler" multiple />
                        <x-jet-input-error for="images" class="mt-2" />
                    </div>

                    <x-jet-button class="float-right">
                        {{ __('Kaydet') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

