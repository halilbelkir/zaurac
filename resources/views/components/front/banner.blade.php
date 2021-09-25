<header class="pages-header bg-img valign parallaxie" data-background="{{ ImageHelper::getImage($image, 1920, 726) }}" data-overlay-dark="5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cont text-center">
                    <h1>{{$title}}</h1>
                    <x-front.breadcrumb>
                        <x-slot name="oneStep">{{$oneStep}}</x-slot>
                        <x-slot name="oneStepLink">{{$oneStepLink ?? 'null'}}</x-slot>
                        <x-slot name="twoStep">{{$twoStep ?? 'null'}}</x-slot>
                    </x-front.breadcrumb>
                </div>
            </div>
        </div>
    </div>
</header>
