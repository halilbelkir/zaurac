@if(count($blog) > 0)
    <section class="blog-grid section-padding">
    <div class="container">
        <div class="sec-head custom-font text-center">
            <h6 class="wow fadeIn" data-wow-delay=".5s">en son yazılar</h6>
            <h3 class="wow" data-splitting>zauracblog</h3>
            <span class="tbg">zauracblog</span>
        </div>
        <div class="row">
            @foreach($blog as $order => $post)
                <div class="col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                    <div class="item border @if(count($blog) == 1) active @elseif($order == 1) active @endif bg-img"
                         data-background="{{ ImageHelper::getImage(json_decode($post->images,true)[0]['image'], 370, 370) }}">
                        <div class="cont">

                            <a href="{{route('blog.detail',$post->seflink)}}" class="date custom-font">
                                {!! \App\Helpers\Helpers::blogDate($post->created_at) !!}
                            </a>
                            <h6>
                                <a href="{{route('blog.detail',$post->seflink)}}">
                                    {{$post->title}}
                                </a>
                            </h6>
                            <div class="btn-more custom-font">
                                <a href="{{route('blog.detail',$post->seflink)}}" class="simple-btn">devamını oku</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
