<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Basında Biz Düzenle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('media.update',$media->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                        <div>
                            <x-jet-label for="link" value="Link" />
                            @if(!empty(old('link')))
                                <x-jet-input id="link" name="link" type="url" value="{{old('link')}}" class="mt-1 block"  placeholder="Link" />
                            @else
                                <x-jet-input id="link" name="link" type="url" value="{{$media->link}}" class="mt-1 block"  placeholder="Link" />
                            @endif
                            <x-jet-input-error for="link" class="mt-2" />
                        </div>

                        @if(empty($media->image))
                            <div>
                                <x-jet-label for="image" value="Resim" />
                                <x-jet-input id="image" name="image" type="file" value="{{old('image')}}" class="mt-1 block"  placeholder="Resim" />
                                <x-jet-input-error for="image" class="mt-2" />
                            </div>
                        @else
                            <div>
                                <img class="rounded-full h-24 w-24 object-cover mb-3" src="{{asset($media->image)}}" alt="">
                                <a onclick="return confirm('Resmi silmek istediğinize emin misiniz?')" href="{{route('media.destroy.image',$media->id)}}" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span> Resmi Sil</a>
                            </div>
                        @endif
                    </div>

                    <x-jet-button class="float-right">
                        {{ __('Kaydet') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

