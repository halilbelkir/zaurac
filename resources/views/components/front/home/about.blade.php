<div class="about section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="img-mons">
                    <div class="row">
                        <div class="col-md-5 cmd-padding valign">
                            <div class="img1 wow imago" data-wow-delay=".5s">
                                {!! ImageHelper::createTag('front/images/intro/1.jpg',['width' =>[188], 'height' => [200]],['class'=> 'lazy','alt' => $metaTitle,'title' => $metaTitle],'lazy') !!}
                            </div>
                        </div>
                        <div class="col-md-7 cmd-padding">
                            <div class="img2 wow imago" data-wow-delay=".3s">
                                {!! ImageHelper::createTag('front/images/intro/3.jpg',['width' =>[272], 'height' => [240]],['class'=> 'lazy','alt' => $metaTitle,'title' => $metaTitle],'lazy') !!}
                            </div>
                            <div class="img3 wow imago" data-wow-delay=".8s">
                                {!! ImageHelper::createTag('front/images/intro/2.jpg',['width' =>[200], 'height' => [200]],['class'=> 'lazy','alt' => $metaTitle,'title' => $metaTitle],'lazy') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 valign">
                <div class="content">
                    <div class="sub-title">
                        <h6>Biz Kimiz</h6>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <h3 class="main-title wow" data-splitting>Biz bir dijital ajanstan <br> daha fazlasıyız.</h3>
                    <p class="wow txt mb-3" data-splitting>{{$settings->description}}</p>
                    <a href="{{route('about')}}" class="btn-curve btn-blc wow fadeInUp" data-wow-delay=".5s"><span>devam et</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
