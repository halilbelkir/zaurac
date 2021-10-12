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

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3010.192014757601!2d29.191308015414446!3d41.021054879299534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cacf7b6fa77f13%3A0xf30347555a13e30a!2sZaurac!5e0!3m2!1str!2str!4v1634033042440!5m2!1str!2str" height="450" style="border:0;width: 100%" allowfullscreen="" loading="lazy"></iframe>
    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <style>
            #toast-container
            {
                z-index: 9999999999999;
            }
            .grecaptcha-badge
            {
                display: none;
            }
        </style>
    @endsection
    @section('js')
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="{{asset('front/js/toastr.min.js')}}"></script>
        <script>
            function onSubmit(token) {
                document.getElementById("contact").submit();
            }
        </script>
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
