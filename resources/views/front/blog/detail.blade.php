<x-front.front>
    <x-slot name="header">
        <x-front.banner :image="json_decode($blog->images,true)[0]['image']">
            <x-slot name="title">{{$blog->title}}</x-slot>
            <x-slot name="oneStep">zauracblog</x-slot>
            <x-slot name="twoStep">{{$blog->title}}</x-slot>
            <x-slot name="oneStepLink">{{route('blog.list')}}</x-slot>
        </x-front.banner>
    </x-slot>

    <section class="intro-section section-padding ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text wow txt" data-splitting>
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-front.home.contact></x-front.home.contact>
</x-front.front>
