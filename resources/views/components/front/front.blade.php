<!DOCTYPE html>
<html lang="tr">

<head>

    <!-- Metas -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="keywords" content="aaaa" />
    <meta name="description" content="aaaa" />
    <meta name="author" content="Zaurac"/>
    <title>Zaurac</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('images/fav.png')}}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,600,700,800,900&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@200;300;400;500;600;700&amp;display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="{{mix('css/front/front.css')}}" />
    @yield('css')
</head>

<body>
<div id="preloader"></div>

<div class="progress-wrap cursor-pointer">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<div class="mouse-cursor cursor-outer"></div>
<div class="mouse-cursor cursor-inner"></div>

<div class="container">
    <div id="navi" class="topnav">
        <div class="container-fluid">
            <div class="logo">
                <a href="{{route('index')}}"><img src="{{asset('front/images/logo-beyaz.png')}}" alt=""></a>
            </div>
            <div class="menu-icon">
                        <span class="icon">
                            <i></i>
                            <i></i>
                        </span>
                <span class="text" data-splitting>Menü</span>
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

                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('projects.list')}}" class="link"><span class="nm">05.</span> projelerimiz</a>
                                </div>
                            </li>

                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('blog.list')}}" class="link"><span class="nm">06.</span> zauracblog</a>
                                </div>
                            </li>

                            <li>
                                <div class="o-hidden">
                                    <a href="{{route('contact')}}" class="link"><span class="nm">07.</span> iletişim</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="cont-info">
                        <div class="item">
                            <h6>telefon :</h6>
                            <p>+90 534-223-3232</p>
                        </div>
                        <div class="item">
                            <h6>adres :</h6>
                            <p>çamlık mahallesi emre sokak no:24 daire:7 çekmeköy/istanbul</p>
                        </div>
                        <div class="item">
                            <h6>email :</h6>
                            <p><a href="mailto:merhaba@zaurac.io">merhaba@zaurac.io</a></p>
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
