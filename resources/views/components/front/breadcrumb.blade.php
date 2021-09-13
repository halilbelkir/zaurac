<div class="path">
    <a href="{{route('index')}}">anasayfa</a>
    @if($twoStep != 'null')
        <span>/</span>
        <a href="{{$oneStepLink}}">{{$oneStep}}</a>
        <span>/</span>
        <a class="active">{{$twoStep}}</a>
    @else
        <span>/</span>
        <a class="active">{{$oneStep}}</a>
    @endif
</div>
