<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Slider Ekle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                        <div>
                            <x-jet-label for="text_1" value="Yazı 1" />
                            <x-jet-input id="text_1" name="text_1" type="text" value="{{old('text_1')}}" class="mt-1 block"  placeholder="Yazı 1" />
                            <x-jet-input-error for="text_1" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="text_2" value="Yazı 2" />
                            <x-jet-input id="text_2" name="text_2" type="text" value="{{old('text_2')}}" class="mt-1 block"  placeholder="Yazı 2" />
                            <x-jet-input-error for="text_2" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="text_3" value="Yazı 3" />
                            <x-jet-input id="text_3" name="text_3" type="text" value="{{old('text_3')}}" class="mt-1 block"  placeholder="Yazı 3" />
                            <x-jet-input-error for="text_3" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="button_text" value="Buton Yazı" />
                            <x-jet-input id="button_text" name="button_text" type="text" value="{{old('button_text')}}" class="mt-1 block"  placeholder="Buton Yazı" />
                            <x-jet-input-error for="button_text" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="button_route" value="Buton Link" />
                            <x-select-box name="button_route" id="button_route">
                                <x-slot name="option">
                                    <option value="">Buton Link Seçiniz</option>
                                    <optgroup label="Hizmetler">
                                        <option
                                            @if(old('button_route') == 'services.list') selected @endif
                                        value="services"
                                        >
                                            Hizmetler Hepsi
                                        </option>
                                        @foreach($services as $service)
                                            <option
                                                @if(old('button_route') == 'services.detail,'.$service->seflink) selected @endif
                                                value="services,{{$service->seflink}}"
                                            >
                                                    {{$service->title}}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Basında Biz">
                                        <option
                                            @if(old('button_route') == 'media') selected @endif
                                        value="media"
                                        >
                                            Basında Biz Hepsi
                                        </option>
                                        @foreach($media as $mediaa)
                                            <option
                                                @if(old('button_route') == 'media,'.$mediaa->link) selected @endif
                                            value="media,{{$mediaa->link}}"
                                            >
                                                {{$mediaa->link}}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Blog">
                                        <option
                                            @if(old('button_route') == 'blog.list') selected @endif
                                        value="blog.list"
                                        >
                                            Blog Hepsi
                                        </option>
                                        @foreach($blog as $blogg)
                                            <option
                                                @if(old('button_route') == 'blog.detail,'.$blogg->seflink) selected @endif
                                            value="blog.detail,{{$blogg->seflink}}"
                                            >
                                                {{$blogg->title}}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Ödüllerimiz">
                                        <option
                                            @if(old('button_route') == 'awards') selected @endif
                                        value="awards"
                                        >
                                            Ödüllerimiz Hepsi
                                        </option>
                                        @foreach($awards as $award)
                                            <option
                                                @if(old('button_route') == 'awards,'.$award->link) selected @endif
                                            value="awards,{{$award->link}}"
                                            >
                                                {{$award->title}}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    <option @if(old('button_route') == 'gallery') selected @endif value="gallery">
                                        Galeri
                                    </option>
                                    <option @if(old('button_route') == 'clients') selected @endif value="clients">
                                        Referanslar
                                    </option>
                                    <option @if(old('button_route') == 'trainings') selected @endif value="trainings">
                                        Eğitimler
                                    </option>
                                    <option @if(old('button_route') == 'online') selected @endif value="online">
                                        Yurt Dışı Online Danışmanlık
                                    </option>
                                </x-slot>
                            </x-select-box>
                            <x-jet-input-error for="button_route" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="text_type" value="Yazılar Konumu" />
                            <x-select-box name="text_type" id="text_type">
                                <x-slot name="option">
                                    <option @if(old('text_type') == '1') selected @endif value="1">
                                        Sol
                                    </option>
                                    <option @if(old('text_type') == '2') selected @endif value="2">
                                        Sağ
                                    </option>
                                    <option @if(old('text_type') == '3') selected @endif value="3">
                                        Orta
                                    </option>
                                </x-slot>
                            </x-select-box>
                            <x-jet-input-error for="text_type" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label for="image" value="Resim" />
                            <x-jet-input id="image" name="image" type="file" value="{{old('image')}}" class="mt-1 block"  placeholder="Resim" />
                            <x-jet-input-error for="image" class="mt-2" />
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

