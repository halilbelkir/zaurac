<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ekibimiz Ekle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('team.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="ad" value="Ad" />
                            <x-jet-input id="ad" name="ad" type="text" onkeyup="seflink1(this.value,'#seflink')" value="{{old('ad')}}" class="mt-1 block"  placeholder="Ad" />
                            <x-jet-input-error for="ad" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="seflink" value="Seflink" />
                            <x-jet-input id="seflink" name="seflink" type="text" value="{{old('seflink')}}" class="mt-1 block"  placeholder="Seflink" />
                            <x-jet-input-error for="seflink" class="mt-2" />
                        </div>
                    </div>
                    <div>
                        <x-jet-label for="unvan" value="Ünvan" />
                        <x-jet-input id="unvan" name="unvan" type="text" value="{{old('unvan')}}" class="mt-1 block"  placeholder="Ünvan" />
                        <x-jet-input-error for="unvan" class="mt-2" />
                    </div>
                    <div class="mb-5">
                        <x-jet-label for="content" value="İçerik" />
                        <textarea id="content" name="content" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="İçerik" rows="2">{{old('content')}}</textarea>
                        <x-jet-input-error for="content" class="mt-2" />
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="tag" value="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            <x-jet-input id="tag" name="tag" type="text" value="{{old('tag')}}" class="mt-1 block"  placeholder="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            <x-jet-input-error for="tag" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-jet-label for="aciklama" value="İlk Açıklama" />
                            <textarea id="aciklama" maxlength="160" name="aciklama" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="İlk Açıklama" rows="2">@if(!empty(old('aciklama'))){{old('aciklama')}}@endif</textarea>
                            <x-jet-input-error for="aciklama" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="resim" value="Resim" />
                            <x-jet-input id="resim" name="resim" type="file" value="{{old('resim')}}" class="mt-1 block"  placeholder="Resim" />
                            <x-jet-input-error for="resim" class="mt-2" />
                        </div>
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

