<section class="services">
    <div class="container">
        <div class="sec-head custom-font text-center">
            <h6 class="wow fadeIn" data-wow-delay=".5s">en iyi yaptıklarımız</h6>
            <h3 class="wow" data-splitting>hizmetlerimiz.</h3>
            <span class="tbg">hizmetlerimiz</span>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 item-box bg-img wow fadeInLeft" data-wow-delay=".3s"
                 data-background="img/1.jpg">
                <h4 class="custom-font">en iyi <br> yaptıklarımız</h4>
                <a href="{{route('services.list')}}" class="btn-curve btn-bord btn-lit mt-40"><span>hepsini gör</span></a>
            </div>
            @foreach($services as $service)
                <a
                    class="col-lg-3 col-md-6 item-box bg-img wow fadeInLeft"
                    href="{{route('services.detail',$service->seflink)}}">
                    <div
                         data-background="{{ ImageHelper::getImage(json_decode($service->images,true)[0]['image'], 300, 350) }}"
                         data-wow-delay=".5s">
                        <h4 class="custom-font">{{$service->title}}</h4>
                        <p class="text-white">{{$service->description}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="half-bg bottom"></div>
</section>

<style>
    /*
    .services .item-box:before
    {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }*/
    .services .item-box
    {
        background-position: center center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
    }


</style>
