<x-front.front>
    <x-slot name="header">
        <x-front.banner :image="'front/images/3.jpg'">
            <x-slot name="title">hakkımızda</x-slot>
            <x-slot name="oneStep">hakkımızda</x-slot>
        </x-front.banner>
    </x-slot>

    <section class="intro-section section-padding ">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4">
                    <div class="htit sm-mb30">
                        <h4>biz kimiz ?</h4>
                    </div>
                </div>
                <div class="col-lg-10 col-md-8">
                    <div class="text wow txt" data-splitting>
                        {!! $settings->hakkimizda !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-front.home.contact></x-front.home.contact>
</x-front.front>
