<header class="slider slider-prlx fixed-slider text-center">
    <div class="swiper-container parallax-slider">
        <div class="swiper-wrapper">
            @foreach($slider as $order => $slide)
                @if($order == 0)
                    @section('preload')
                        <link rel="preload" as="image" href="{{ ImageHelper::getImage($slide->image, 1920, 1080) }}">
                    @endsection
                @endif
                <div class="swiper-slide">
                    <div class="bg-img valign" data-background="{{ ImageHelper::getImage($slide->image, 1920, 1080) }}" data-overlay-dark="6">
                        <div class="container">
                            <div class="row @if($slide->text_type == 1) @elseif($slide->text_type == 2) justify-content-end @else justify-content-center @endif">
                                <div class="col-lg-7 col-md-9">
                                    <div class="caption dig">
                                        @if(!empty($slide->text_1))
                                            <h1 data-splitting>
                                                {{$slide->text_1}}
                                            </h1>
                                        @endif
                                        @if(!empty($slide->text_2))
                                            <p>
                                                {{$slide->text_2}}
                                            </p>
                                        @endif
                                        @if(!empty($slide->button_text) && !empty($slide->button_route))
                                            @php
                                                $route = $slide->button_route;
                                                if (strstr($route,','))
                                                {
                                                    $route       = explode(',',$route);

                                                    if ($route[0] == 'awards' || $route[0] == 'media')
                                                    {
                                                        $slide_route = $route[1];
                                                    }
                                                    else
                                                    {
                                                        $slide_route = route($route[0],$route[1]);
                                                    }
                                                }
                                                else
                                                {
                                                    if ($route == 'trainings')
                                                    {
                                                        $slide_route = url($trainings->seflink);
                                                    }
                                                    else if ($route == 'online')
                                                    {
                                                        $slide_route = url($online->seflink);
                                                    }
                                                    else
                                                    {
                                                        $slide_route = route($route);
                                                    }

                                                }
                                            @endphp
                                                <a href="{{$slide_route}}" class="btn-curve btn-lit mt-30">
                                                    <span>{{$slide->button_text}}</span>
                                                </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- slider setting -->
        <div class="setone setwo">
            <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
                <i class="fas fa-chevron-right"></i>
            </div>
            <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>
        <div class="swiper-pagination top botm custom-font"></div>
    </div>
</header>
