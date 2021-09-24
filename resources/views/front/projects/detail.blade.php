<x-front.front>
    <x-slot name="header">
        <x-front.banner>
            <x-slot name="title">proje başlık</x-slot>
            <x-slot name="oneStep">projelerimiz</x-slot>
            <x-slot name="twoStep">proje başlık</x-slot>
            <x-slot name="oneStepLink">{{route('projects.list')}}</x-slot>
            <x-slot name="image">front/images/2.jpg</x-slot>
        </x-front.banner>
    </x-slot>

    <section class="intro-section section-padding ">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4">
                    <div class="htit sm-mb30">
                        <h4>proje başlık proje başlık</h4>
                    </div>
                </div>
                <div class="col-lg-10 col-md-8">
                    <div class="text">
                        <p class="wow txt" data-splitting>
                            We develop creative solutions for small and big brands alike, build authentic product
                            identities and much more.Lorem ipsum dolor sit amet, consectetur adipiscing elit sit non
                            facilisis vitae eu. Ultrices ut diam morbi risus dui, nec eget at lorem in id tristique
                            in elementum leo nisi eleifend placerat magna lacus elementum ornare vehicula odio
                            posuere quisque ultrices tempus cras id blandit maecenas in ornare quis dolor tempus
                            risus vitae feugiat fames aliquet sed.
                            We develop creative solutions for small and big brands alike, build authentic product
                            identities and much more.Lorem ipsum dolor sit amet, consectetur adipiscing elit sit non
                            facilisis vitae eu. Ultrices ut diam morbi risus dui, nec eget at lorem in id tristique
                            in elementum leo nisi eleifend placerat magna lacus elementum ornare vehicula odio
                            posuere quisque ultrices tempus cras id blandit maecenas in ornare quis dolor tempus
                            risus vitae feugiat fames aliquet sed.
                            We develop creative solutions for small and big brands alike, build authentic product
                            identities and much more.Lorem ipsum dolor sit amet, consectetur adipiscing elit sit non
                            facilisis vitae eu. Ultrices ut diam morbi risus dui, nec eget at lorem in id tristique
                            in elementum leo nisi eleifend placerat magna lacus elementum ornare vehicula odio
                            posuere quisque ultrices tempus cras id blandit maecenas in ornare quis dolor tempus
                            risus vitae feugiat fames aliquet sed.
                            We develop creative solutions for small and big brands alike, build authentic product
                            identities and much more.Lorem ipsum dolor sit amet, consectetur adipiscing elit sit non
                            facilisis vitae eu. Ultrices ut diam morbi risus dui, nec eget at lorem in id tristique
                            in elementum leo nisi eleifend placerat magna lacus elementum ornare vehicula odio
                            posuere quisque ultrices tempus cras id blandit maecenas in ornare quis dolor tempus
                            risus vitae feugiat fames aliquet sed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="projdtal">
        <div class="justified-gallery">
            <a href="/front/images/3.jpg">
                <img alt="" src="/front/images/3.jpg" />
            </a>
            <a href="/front/images/2.jpg">
                <img alt="" src="/front/images/2.jpg" />
            </a>

            <a href="/front/images/9.jpg">
                <img alt="" src="/front/images/9.jpg" />
            </a>
        </div>
    </section>
    <x-front.home.contact></x-front.home.contact>
    @section('css')
        <link rel="stylesheet" href="{{asset('front/css/simpleLightbox.min.css')}}" />
    @endsection
    @section('js')
        <script src="{{asset('front/js/simpleLightbox.min.js')}}"></script>
        <script>

            $('.justified-gallery a').simpleLightbox();
        </script>
    @endsection
</x-front.front>

