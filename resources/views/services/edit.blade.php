<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hizmet Düzenle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('services.update',$services->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="title" value="Başlık" />
                            @if(!empty(old('title')))
                                <x-jet-input id="title" name="title" onkeyup="seflink1(this.value,'#seflink')" type="text" value="{{old('title')}}" class="mt-1 block"  placeholder="Başlık" />
                            @else
                                <x-jet-input id="title" name="title" onkeyup="seflink1(this.value,'#seflink')" type="text" value="{{$services->title}}" class="mt-1 block"  placeholder="Başlık" />
                            @endif
                            <x-jet-input-error for="title" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="seflink" value="Seflink" />
                            @if(!empty(old('seflink')))
                                <x-jet-input id="seflink" name="seflink" type="text" value="{{old('seflink')}}" class="mt-1 block"  placeholder="Seflink" />
                            @else
                                <x-jet-input id="seflink" name="seflink" type="text" value="{{$services->seflink}}" class="mt-1 block"  placeholder="Seflink" />
                            @endif
                            <x-jet-input-error for="seflink" class="mt-2" />
                        </div>

                    </div>

                    <div>
                        <x-jet-label for="content" value="İçerik" />
                        <textarea id="content" name="content" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="İçerik" rows="2">@if(empty(old('content'))) {{$services->content}} @else {{old('content')}} @endif</textarea>
                        <x-jet-input-error for="content" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 mb-3">
                        <div>
                            <x-jet-label for="tag" value="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            @if(!empty(old('tag')))
                                <x-jet-input id="tag" name="tag" type="text" value="{{old('tag')}}" class="mt-1 block"  placeholder="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            @else
                                <x-jet-input id="tag" name="tag" type="text" value="{{$services->tag}}" class="mt-1 block"  placeholder="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            @endif
                            <x-jet-input-error for="tag" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="description" value="İlk Açıklama" />
                            <textarea id="description" name="description" maxlength="160" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="İlk Açıklama" rows="2">@if(empty(old('description'))) {{$services->description}} @else {{old('description')}} @endif</textarea>
                            <x-jet-input-error for="description" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-5">
                        <x-jet-label for="images" value="Resimler" />
                        <x-jet-input id="images" name="images[]" type="file" value="{{old('images')}}" class="mt-1 block"  placeholder="Resimler" multiple />
                        <x-jet-input-error for="images" class="mt-2" />
                    </div>
                    @if(!empty($services->images))
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 mb-3">
                            @foreach(json_decode($services->images) as $order => $image)
                                <div>
                                    <img class="rounded-full h-24 w-24 object-cover mb-3" src="{{asset($image->image)}}" alt="">
                                    <a onclick="return confirm('Resmi silmek istediğinize emin misiniz?')" href="{{route('services.destroy.image',['id' =>$services->id,'order' => $order])}}" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span> Resim Sil</a>
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
    @section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/maxlength/jquery.maxlength.css')}}">
    @endsection
    @section('script')
        <script type="text/javascript" src="{{asset('plugins/maxlength/jquery.plugin.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('plugins/maxlength/jquery.maxlength.min.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        <script>
            $(function() {
                $('#description').maxlength({
                    feedbackText: '{r}/({m})',
                    overflowText: 'En fazla ({m} karakter olmalıdır)',
                    max: 160,
                    truncate: true,
                    showFeedback: true,
                    feedbackTarget: null,
                    onFull: null
                });
            });
            CKEDITOR.replace('content', {
                height: 200,
                // By default, some basic text styles buttons are removed in the Standard preset.
                // The code below resets the default config.removeButtons setting.
                removeButtons: '',
                // Custom style definition for the Bold feature.
                coreStyles_bold: {
                    element: 'b',
                    overrides: 'strong'
                },
                // Custom style definition for the Italic feature.
                coreStyles_italic: {
                    element: 'i',
                    overrides: 'em'
                }
            });
        </script>
    @endsection
</x-app-layout>

