<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Referans Düzenle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">

                <form action="{{route('references.update',$references->id)}}" method="post">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                        <div>
                            <x-jet-label for="url" value="Link" />
                            @if(!empty(old('url')))
                                <x-jet-input value="{{old('url')}}" name="url" type="text"  class="mt-1 block" placeholder="Link" />
                            @else
                                <x-jet-input value="{{$references->url}}" name="url" type="text"  class="mt-1 block" placeholder="Link" />
                            @endif
                            <x-jet-input-error for="url" class="mt-2" />
                        </div>
                    </div>

                    @if(!empty($references->image))
                        <div>
                            <img class="rounded-full h-24 w-24 object-cover mb-3" src="{{asset($references->image)}}" alt="">
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

