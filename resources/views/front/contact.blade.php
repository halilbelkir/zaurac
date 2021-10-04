<x-front.front>
    <x-slot name="header">
        <x-front.banner :image="'front/images/contact.jpg'">
            <x-slot name="title">iletişim</x-slot>
            <x-slot name="oneStep">iletişim</x-slot>
        </x-front.banner>
    </x-slot>
    <section class="contact section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form md-mb50">

                        <form method="post" id="contact" action="{{route('contact.send')}}">
                            @csrf

                            <div class="controls">

                                <div class="form-group">
                                    <input id="form_name" type="text" name="name" placeholder="ad & soyad"
                                           required="required">
                                </div>

                                <div class="form-group">
                                    <input id="email" type="email" name="email" placeholder="e-mail"
                                           required="required">
                                </div>

                                <div class="form-group">
                                        <textarea id="form_message" name="message" placeholder="mesaj" rows="4"
                                                  required="required"></textarea>
                                </div>
                                <button class="g-recaptcha btn-curve btn-color form-button"
                                        data-sitekey="6LdP6ascAAAAAEvmck58Kb7WzFPXGyJdjHy2M5do"
                                        data-callback='onSubmit'
                                        data-action='submit'><span>gönder</span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="cont-info">
                        </h3>
                        <div class="item mb-40">
                            <h5><a href="mailto:{{$settings->email}}">{{$settings->email}}</a></h5>
                            <h5><a href="tel:{{$settings->telefon}}">{{$settings->telefon}}</a></h5>
                        </div>
                        <h3 class="custom-font wow" data-splitting>ziyaret edin.
                        </h3>
                        <div class="item">
                            <h6>
                                {{$settings->adres}}
                            </h6>
                        </div>
                        <div class="social mt-50">
                            @if(!empty($settings->instagram))
                                <a href="{{$settings->instagram}}" target="_blank" class="icon">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif

                            @if(!empty($settings->linkedin))
                                <a href="{{$settings->linkedin}}" target="_blank" class="icon">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== End Contact ==================== -->


    <!-- ==================== Start Map ==================== -->

    <div class="map" id="ieatmaps"></div>

    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <style>
            #toast-container
            {
                z-index: 9999999999999;
            }
        </style>
    @endsection
    @section('js')
        <script src="{{asset('front/js/map.js')}}"></script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJHiMBS1q1CjLTaq3OL8NhqSvsQo9Eme4&callback=initMap">
        </script>

        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="{{asset('front/js/toastr.min.js')}}"></script>
        @if (session('message'))
            @if(session('message')[2] == 'success')
                <script>
                    toastr.success('{{ session('message')[1] }}','{{ session('message')[0] }}');
                </script>
            @endif
            @if(session('message')[2] == 'error')
                <script>
                    toastr.error('{{ session('message')[1] }}','{{ session('message')[0] }}');
                </script>
            @endif
        @endif
    @endsection
</x-front.front>
