<x-front.front>
    <x-slot name="header">
        <x-front.banner>
            <x-slot name="title">zauracblog</x-slot>
            <x-slot name="oneStep">zauracblog</x-slot>
            <x-slot name="image">front/images/3.jpg</x-slot>
        </x-front.banner>
    </x-slot>

    <section class="blog-grid section-padding pb-70">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                    <div class="item border bg-img" data-background="/front/images/3.jpg">
                        <div class="cont">
                            <a href="{{route('blog.detail','blog-detay')}}" class="date custom-font">
                                <span><i>06</i> Aug 2019</span>
                            </a>
                            <div class="info custom-font">
                                <a href="{{route('blog.detail','blog-detay')}}" class="author">
                                    <span>by / Admin</span>
                                </a>
                                <a href="{{route('blog.detail','blog-detay')}}" class="tag">
                                    <span>WordPress</span>
                                </a>
                            </div>
                            <h6>
                                <a href="{{route('blog.detail','blog-detay')}}">The Start-Up Ultimate Guide to Make Your WordPress
                                    Journal.</a>
                            </h6>
                            <div class="btn-more custom-font">
                                <a href="{{route('blog.detail','blog-detay')}}" class="simple-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay=".6s">
                    <div class="item border active bg-img" data-background="/front/images/3.jpg">
                        <div class="cont">
                            <a href="{{route('blog.detail','blog-detay')}}" class="date custom-font">
                                <span><i>06</i> Aug 2019</span>
                            </a>
                            <div class="info custom-font">
                                <a href="{{route('blog.detail','blog-detay')}}" class="author">
                                    <span>by / Admin</span>
                                </a>
                                <a href="{{route('blog.detail','blog-detay')}}" class="tag">
                                    <span>WordPress</span>
                                </a>
                            </div>
                            <h6>
                                <a href="{{route('blog.detail','blog-detay')}}">The Start-Up Ultimate Guide to Make Your WordPress
                                    Journal.</a>
                            </h6>
                            <div class="btn-more custom-font">
                                <a href="{{route('blog.detail','blog-detay')}}" class="simple-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow  fadeInUp" data-wow-delay=".9s">
                    <div class="item bg-img border" data-background="/front/images/3.jpg">
                        <div class="cont">
                            <a href="{{route('blog.detail','blog-detay')}}" class="date custom-font">
                                <span><i>06</i> Aug 2019</span>
                            </a>
                            <div class="info custom-font">
                                <a href="{{route('blog.detail','blog-detay')}}" class="author">
                                    <span>by / Admin</span>
                                </a>
                                <a href="{{route('blog.detail','blog-detay')}}" class="tag">
                                    <span>WordPress</span>
                                </a>
                            </div>
                            <h6>
                                <a href="{{route('blog.detail','blog-detay')}}">The Start-Up Ultimate Guide to Make Your WordPress
                                    Journal.</a>
                            </h6>
                            <div class="btn-more custom-font">
                                <a href="{{route('blog.detail','blog-detay')}}" class="simple-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <x-front.home.contact></x-front.home.contact>
</x-front.front>
