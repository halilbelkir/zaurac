<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('gallery Düzenle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('gallery.update',$gallery->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                        <div>
                            <x-jet-label for="category_name" value="Kategori Adı" />
                            @if(!empty(old('category_name')))
                                <x-jet-input id="category_name" name="category_name" type="text" value="{{old('category_name')}}" class="mt-1 block"  placeholder="Kategori Adı" />
                            @else
                                <x-jet-input id="category_name" name="category_name" type="text" value="{{$gallery->category_name}}" class="mt-1 block"  placeholder="Kategori Adı" />
                            @endif
                            <x-jet-input-error for="category_name" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="youtube_link" value="Youtube Linkleri (Her linki virgül ile ayırınız.)" />
                            <textarea id="youtube_link" name="youtube_link" maxlength="160" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="Youtube Linkleri (Her linki virgül ile ayırınız.)" rows="2">@if(empty(old('youtube_link'))) {{$gallery->youtube_link}} @else {{old('youtube_link')}} @endif</textarea>
                            <x-jet-input-error for="youtube_link" class="mt-2" />
                        </div>

                    </div>

                    <div class="mb-5">
                        <x-jet-label for="images" value="Resimler" />
                        <x-jet-input id="images" name="images[]" type="file" value="{{old('images')}}" class="mt-1 block"  placeholder="Resimler" multiple />
                        <x-jet-input-error for="images" class="mt-2" />
                    </div>
                    @if(!empty($gallery->images))
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 mb-3">
                            @foreach(json_decode($gallery->images) as $order => $image)
                                <div>
                                    <img class="rounded-full h-24 w-24 object-cover mb-3" src="{{asset($image->image)}}" alt="">
                                    <a onclick="return confirm('Resmi silmek istediğinize emin misiniz?')" href="{{route('gallery.destroy.image',['id' =>$gallery->id,'order' => $order])}}" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span> Resim Sil</a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <x-jet-button class="float-right">
                        {{ __('Kaydet') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

