<x-front.front>
    <x-slot name="header">
        <x-front.banner>
            <x-slot name="title">referanslarımız</x-slot>
            <x-slot name="oneStep">referanslarımız</x-slot>
            <x-slot name="image">front/images/3.jpg</x-slot>
        </x-front.banner>
    </x-slot>

    <section class="clients section-padding ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach($clients as $client)
                            <div class="col-md-3 col-6 brands mb-15">
                                <div class="item wow fadeIn" data-wow-delay=".3s">
                                    <div class="img">
                                        {!! ImageHelper::createTag($client->image,['width' =>[75], 'height' => [21]],['class'=> 'lazy','alt' => $client->url,'title' => $client->url],'lazy') !!}
                                        <a href="{{$client->url}}" target="_blank" class="link" data-splitting>{{\App\Helpers\Helpers::urlHttpDelete($client->url)}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-front.home.contact></x-front.home.contact>
</x-front.front>
