<section class="clients section-padding sub-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 valign">
                <div class="sec-head custom-font mb-0">
                    <h6>Müşteriler</h6>
                    <h3>Müşteri <br>lerimiz</h3>
                </div>
            </div>
            <div class="col-lg-8">
                <div>
                    <div class="row bord">
                        @foreach($clients as $client)
                            <div class="col-md-3 col-6 brands">
                                <div class="item wow fadeIn" data-wow-delay=".3s">
                                    <div class="img">
                                        {!! ImageHelper::createTag($client->image,['width' =>[130], 'height' => [40]],['class'=> 'lazy','alt' => $client->url,'title' => $client->url],'lazy') !!}
                                        <a href="{{$client->url}}" target="_blank" class="link" data-splitting>{{\App\Helpers\Helpers::urlHttpDelete($client->url)}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
