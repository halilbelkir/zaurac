<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hizmet Ekle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('services.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="title" value="Başlık" />
                            <x-jet-input id="title" name="title" onkeyup="seflink1(this.value,'#seflink')" type="text" value="{{old('title')}}" class="mt-1 block"  placeholder="Başlık" />
                            <x-jet-input-error for="title" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="seflink" value="Seflink" />
                            <x-jet-input id="seflink" name="seflink" type="text" value="{{old('seflink')}}" class="mt-1 block"  placeholder="Seflink" />
                            <x-jet-input-error for="seflink" class="mt-2" />
                        </div>

                    </div>
                    <div class="mb-3">
                        <x-jet-label for="content" value="İçerik" />
                        <textarea id="content" name="content" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="İçerik" rows="2">{{old('content')}}</textarea>
                        <x-jet-input-error for="content" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 mb-3">
                        <div>
                            <x-jet-label for="tag" value="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            <x-jet-input id="tag" name="tag" type="text" value="{{old('tag')}}" class="mt-1 block"  placeholder="Etiket (Kelimeleri virgül ile ayırınız.)" />
                            <x-jet-input-error for="tag" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="description" value="İlk Açıklama" />
                            <textarea id="description" name="description" maxlength="160" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  placeholder="İlk Açıklama" rows="2">{{old('description')}}</textarea>
                            <x-jet-input-error for="description" class="mt-2" />
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

