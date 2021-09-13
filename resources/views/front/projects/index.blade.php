<x-front.front>
    <x-slot name="header">
        <x-front.banner>
            <x-slot name="title">projelerimiz</x-slot>
            <x-slot name="oneStep">projelerimiz</x-slot>
            <x-slot name="image">front/images/3.jpg</x-slot>
        </x-front.banner>
    </x-slot>

    <section class="portfolio section-padding pb-70">
        <div class="container">

            <!-- gallery -->
            <div class="gallery full-width">

                <!-- gallery item -->
                <div class="col-md-6 items graphic lg-mr">
                    <div class="item-img wow fadeInUp" data-wow-delay=".4s">
                        <a href="{{route('projects.detail','proje-baslik')}}">
                            <img src="/front/images/3.jpg" alt="image">
                        </a>
                    </div>
                    <div class="cont">
                        <h6>proje başlık</h6>
                    </div>
                </div>

                <div class="col-md-6 items graphic lg-mr">
                    <div class="item-img wow fadeInUp" data-wow-delay=".4s">
                        <a href="{{route('projects.detail','proje-baslik')}}">
                            <img src="/front/images/2.jpg" alt="image">
                        </a>
                    </div>
                    <div class="cont">
                        <h6>proje başlık</h6>
                    </div>
                </div>

                <div class="col-md-6 items graphic lg-mr">
                    <div class="item-img wow fadeInUp" data-wow-delay=".4s">
                        <a href="{{route('projects.detail','proje-baslik')}}">
                            <img src="/front/images/9.jpg" alt="image">
                        </a>
                    </div>
                    <div class="cont">
                        <h6>proje başlık</h6>
                    </div>
                </div>


            </div>

        </div>
    </section>

    <x-front.home.contact></x-front.home.contact>
</x-front.front>
