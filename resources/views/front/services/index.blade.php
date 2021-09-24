<x-front.front>
    <x-slot name="header">
        <x-front.banner>
            <x-slot name="title">hizmetlerimiz</x-slot>
            <x-slot name="oneStep">hizmetlerimiz</x-slot>
            <x-slot name="image">front/images/3.jpg</x-slot>
        </x-front.banner>
    </x-slot>

    <section class="portfolio section-padding pb-70">
        <div class="container">

            <!-- gallery -->
            <div class="gallery full-width">

                @foreach($services as $service)
                    <div class="col-md-6 items">
                        <div class="item-img wow fadeInUp" data-wow-delay=".4s">
                            <a href="{{route('services.detail',$service->seflink)}}">
                                {!! ImageHelper::createTag(json_decode($service->images,true)[0]['image'],['width' =>[400], 'height' => [400]],['class'=> 'lazy','alt' => $service->title,'title' => $service->title],'lazy') !!}
                            </a>
                        </div>
                        <div class="cont">
                            <h6>{{$service->title}}</h6>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>
    <x-front.home.contact></x-front.home.contact>
</x-front.front>
