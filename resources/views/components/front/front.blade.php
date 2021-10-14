<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="default-src * gap:; script-src * 'unsafe-inline' 'unsafe-eval'; connect-src *; img-src * data: blob: android-webview-video-poster:; style-src * 'unsafe-inline';">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{$keywords}}" />
    <meta name="description" content="{{$description}}" />
    <meta property="og:image" content="{{$ogImage}}" >
    <meta property="og:title" style="text-transform:capitalize;" content="{{$metaTitle}}">
    <meta property="og:description" content="{{$description}}" >
    <meta property="og:type" content="website" >
    <meta property="og:url" content="{{request()->fullUrl()}}" >
    <meta property="fb:app_id" content="538454817224962" >
    <meta name="author" content="Zaurac"/>
    <title>{{$metaTitle}}</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/front/images/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/front/images/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/front/images/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/front/images/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/front/images/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/front/images/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/front/images/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/front/images/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/front/images/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/front/images/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/front/images/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/front/images/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/front/images/fav/favicon-16x16.png">
    <meta name="msapplication-TileImage" content="/front/images/fav/ms-icon-144x144.png" >
    <meta name="theme-color" content="#FBC02D" >
    <link rel="manifest" href="/front/images/fav/manifest.json" >

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@200;300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@100;200;300;400;500;600;700;800;900&display=swap" onload="this.rel='stylesheet'">
    <link rel="preload" as="image" href="{{ ImageHelper::getImage('front/images/logo-beyaz.png', 150, 60) }}" media="(min-width: 992px)">
    <link rel="preload" as="image" href="{{ ImageHelper::getImage('front/images/logo-beyaz.png', 100, 40) }}" media="(max-width: 991px)">
    <link rel="preload" as="style" href="{{mix('css/front/preload.css')}}" onload="this.rel='stylesheet'">
    <link rel="stylesheet" type="text/css" href="{{mix('css/front/front.css')}}">
    @yield('css')
    @yield('preload')
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V1HC7PBYJR"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-V1HC7PBYJR');
    </script>
</head>

<body>


<div class="mouse-cursor cursor-outer"></div>
<div class="mouse-cursor cursor-inner"></div>

<div class="container">
    <div id="navi" class="topnav">
        <div class="container-fluid">
            <div class="logo">

                <a href="{{route('index')}}">
                    {!! ImageHelper::createTag('front/images/logo-beyaz.png',['width' =>[150], 'height' => [60]],['class'=> 'lazy d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block','alt' => $metaTitle,'title' => $metaTitle],'lazy') !!}
                    {!! ImageHelper::createTag('front/images/logo-beyaz.png',['width' =>[100], 'height' => [40]],['class'=> 'lazy d-sm-block d-md-none d-lg-none d-xl-none d-xxl-none','alt' => $metaTitle,'title' => $metaTitle],'lazy') !!}
                </a>
            </div>
            <div class="menu-icon">
                        <span class="icon">
                            <i></i>
                            <i></i>
                        </span>
                <span class="text" data-splitting>menü</span>
            </div>
        </div>
    </div>

    <div class="hamenu">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="menu-links">
                        <ul class="main-menu">
                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('index')}}" class="link"><span class="nm">01.</span> anasayfa</a>
                                </div>
                            </li>
                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('about')}}" class="link"><span class="nm">02.</span> hakkımızda</a>
                                </div>
                            </li>
                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('services.list')}}" class="link"><span class="nm">03.</span> hizmetlerimiz</a>
                                </div>
                            </li>
                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('clients')}}" class="link"><span class="nm">04.</span> referanslarımız</a>
                                </div>
                            </li>
<!--
                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('projects.list')}}" class="link"><span class="nm">05.</span> projelerimiz</a>
                                </div>
                            </li>
-->
                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('blog.list')}}" class="link"><span class="nm">05.</span> zauracblog</a>
                                </div>
                            </li>

                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('contact')}}" class="link"><span class="nm">06.</span> iletişim</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="cont-info">
                        <div class="item">
                            <h6>telefon :</h6>
                            <p>{{$settings->telefon}}</p>
                        </div>
                        <div class="item">
                            <h6>adres :</h6>
                            <p>{{$settings->adres}}</p>
                        </div>
                        <div class="item">
                            <h6>email :</h6>
                            <p><a href="mailto:{{$settings->email}}">{{$settings->email}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{$header}}
<div class="main-content">
    {{$slot}}
    <footer class="footer-half sub-bg  pb-0">
        <div class="copyrights text-center">
            <p>© 2021, zaurac</p>
        </div>
    </footer>

</div>


<script src="{{mix('js/front/front.js')}}"></script>
@yield('js')
</body>

</html>
