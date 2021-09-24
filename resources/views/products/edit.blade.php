<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ayarlar') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('products.update',$products->id)}}" method="post">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="ad" value="ad" />
                            @if(!empty(old('ad')))
                                <x-jet-input value="{{old('ad')}}" onkeyup="seflink1(this.value,'#seflink')" id="ad" name="ad" type="text"  class="mt-1 block" wire:model.defer="settings.telefon" autocomplete="ad" placeholder="ad" />
                            @else
                                <x-jet-input value="{{$products->ad}}" onkeyup="seflink1(this.value,'#seflink')" id="ad" name="ad" type="text"  class="mt-1 block" wire:model.defer="settings.telefon" autocomplete="ad" placeholder="ad" />
                            @endif
                            <x-jet-input-error for="ad" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="seflink" value="Link" />
                            @if(!empty(old('seflink')))
                                <x-jet-input id="seflink" name="seflink" type="text" value="{{old('seflink')}}" class="mt-1 block" autocomplete="seflink" placeholder="Link" />
                            @else
                                <x-jet-input id="seflink" name="seflink" type="text" value="{{$products->seflink}}" class="mt-1 block" autocomplete="seflink" placeholder="Link" />
                            @endif
                            <x-jet-input-error for="seflink" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-jet-label for="aciklama" value="Açıklama" />
                        <textarea id="aciklama" name="aciklama" class="mt-1 mb-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="settings.aciklama" autocomplete="aciklama" placeholder="Açıklama" rows="2">@if(!empty(old('aciklama'))){{old('aciklama')}} @else{{$products->aciklama}}@endif</textarea>
                        <x-jet-input-error for="aciklama" class="mt-2" />
                    </div>

                    <x-jet-button class="float-right">
                        {{ __('Kaydet') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
    @section('script')
        <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('aciklama', {
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

