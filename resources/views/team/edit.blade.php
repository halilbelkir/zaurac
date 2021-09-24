<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ekibimiz Düzenle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('team.update',$team->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="ad" value="Ad" />
                            @if(!empty(old('ad')))
                                <x-jet-input onkeyup="seflink1(this.value,'#seflink')" value="{{old('ad')}}" id="ad" name="ad" type="text"  class="mt-1 block" placeholder="Ad" />
                            @else
                                <x-jet-input onkeyup="seflink1(this.value,'#seflink')" value="{{$team->ad}}" id="ad" name="ad" type="text"  class="mt-1 block" placeholder="Ad" />
                            @endif
                            <x-jet-input-error for="ad" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="seflink" value="Seflink" />
                            @if(!empty(old('seflink')))
                                <x-jet-input id="seflink" name="seflink" type="text" value="{{old('seflink')}}" class="mt-1 block"  placeholder="Seflink" />
                            @else
                                <x-jet-input id="seflink" name="seflink" type="text" value="{{$team->seflink}}" class="mt-1 block"  placeholder="Seflink" />
                            @endif
                            <x-jet-input-error for="seflink" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-jet-label for="unvan" value="Ünvan" />
                        @if(!empty(old('unvan')))
                            <x-jet-input value="{{old('unvan')}}" id="unvan" name="unvan" type="text"  class="mt-1 block" placeholder="Ünvan" />
                        @else
                            <x-jet-input value="{{$team->unvan}}" id="unvan" name="unvan" type="text"  class="mt-1 block" placeholder="Ünvan" />
                        @endif
                        <x-jet-input-error for="unvan" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <x-jet-label for="content" value="İçerik" />
                        <textarea id="content" name="content" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="İçerik" rows="2">@if(empty(old('content'))) {{$team->content}} @else {{old('content')}} @endif</textarea>
                        <x-jet-input-error for="content" class="mt-2" />
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="tag" value="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            @if(!empty(old('tag')))
                                <x-jet-input id="tag" name="tag" type="text" value="{{old('tag')}}" class="mt-1 block"  placeholder="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            @else
                                <x-jet-input id="tag" name="tag" type="text" value="{{$team->tag}}" class="mt-1 block"  placeholder="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            @endif
                            <x-jet-input-error for="tag" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="aciklama" value="İlk Açıklama" />
                            <textarea id="aciklama" maxlength="160" name="aciklama" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="İlk Açıklama" rows="2">@if(!empty(old('aciklama'))){{old('aciklama')}} @else{{$team->aciklama}}@endif</textarea>
                            <x-jet-input-error for="aciklama" class="mt-2" />
                        </div>
                        @if(empty($team->resim))
                            <div>
                                <x-jet-label for="resim" value="Resim" />
                                <x-jet-input id="resim" name="resim" type="file" value="{{old('resim')}}" class="mt-1 block"  placeholder="Resim" />
                                <x-jet-input-error for="resim" class="mt-2" />
                            </div>
                        @else
                            <div>
                                <img class="rounded-full h-24 w-24 object-cover mb-3" src="{{asset($team->resim)}}" alt="">
                                <a onclick="return confirm('Resmi silmek istediğinize emin misiniz?')" href="{{route('team.destroy.image',$team->id)}}" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span> Resim Sil</a>
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

