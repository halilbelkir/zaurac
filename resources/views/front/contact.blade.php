<x-front.front>
    <x-slot name="header">
        <x-front.banner>
            <x-slot name="title">iletişim</x-slot>
            <x-slot name="oneStep">iletişim</x-slot>
            <x-slot name="image">front/images/3.jpg</x-slot>
        </x-front.banner>
    </x-slot>
    <section class="contact section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form md-mb50">

                        <form id="contact-form" method="post" action="contact.php">

                            <div class="messages"></div>

                            <div class="controls">

                                <div class="form-group">
                                    <input id="form_name" type="text" name="name" placeholder="Ad & Soyad"
                                           required="required">
                                </div>

                                <div class="form-group">
                                    <input id="phoneNumber" type="text" name="number" placeholder="Telefon Numarası"  required="required">
                                </div>

                                <div class="form-group">
                                    <input id="email" type="email" name="email" placeholder="Email"
                                           required="required">
                                </div>

                                <div class="form-group">
                                        <textarea id="form_message" name="message" placeholder="Mesaj" rows="4"
                                                  required="required"></textarea>
                                </div>

                                <button type="submit" class="btn-curve btn-color"><span>gönder</span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="cont-info">
                        </h3>
                        <div class="item mb-40">
                            <h5><a href="mailto:merhaba@zaurac.io">merhaba@zaurac.io</a></h5>
                            <h5>+90 534-223-3232</h5>
                        </div>
                        <h3 class="custom-font wow" data-splitting>ziyaret edin.
                        </h3>
                        <div class="item">
                            <h6>
                                çamlık mahallesi emre sokak no:24 daire:7
                                <br>
                                çekmeköy/istanbul
                            </h6>
                        </div>
                        <div class="social mt-50">
                            <a href="#0" class="icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#0" class="icon">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== End Contact ==================== -->


    <!-- ==================== Start Map ==================== -->

    <div class="map" id="ieatmaps"></div>

    @section('js')
        <script src="{{asset('js/front/map.js')}}"></script>
        <script src="{{asset('js/front/jquery.inputmask.min.js')}}"></script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJHiMBS1q1CjLTaq3OL8NhqSvsQo9Eme4&callback=initMap">
        </script>
        <script>
            $("#phoneNumber").inputmask({"mask": "(999) 999 99 99"});
        </script>
    @endsection
</x-front.front>
