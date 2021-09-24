<x-front.front>
    <x-slot name="header">
        <x-front.banner>
            <x-slot name="title">{{$service->title}}</x-slot>
            <x-slot name="oneStep">hizmetlerimiz</x-slot>
            <x-slot name="twoStep">{{$service->title}}</x-slot>
            <x-slot name="oneStepLink">{{route('services.list')}}</x-slot>
            <x-slot name="image">{{json_decode($service->images,true)[0]['image']}}</x-slot>
        </x-front.banner>
    </x-slot>

    <section class="intro-section section-padding ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text wow txt" data-splitting>
                        {!! $service->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-front.home.contact></x-front.home.contact>
</x-front.front>
