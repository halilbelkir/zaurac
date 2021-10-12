<x-front.front>
    <x-slot name="header">
        <x-front.banner :image="'front/images/notfound.jpg'">
            <x-slot name="title">Sayfa Bulunamadı</x-slot>
            <x-slot name="oneStep">Sayfa Bulunamadı</x-slot>
        </x-front.banner>
    </x-slot>

    <section class="intro-section section-padding ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text wow txt" data-splitting>
                        İstediğiniz sayfa bulunamadı.
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-front.home.contact></x-front.home.contact>
</x-front.front>
