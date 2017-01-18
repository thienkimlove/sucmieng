@extends('frontend.template')

@section('content')
    <section class="section vis">
        <div class="container">
            <div class="contentLeft">
                <ul class="breadCrumb clearFix">
                    <li><a href="{{url('/')}}">TRANG CHỦ</a></li>
                    <li class="active"><a href="{{url('hoi-dap')}}">HỎI ĐÁP</a></li>
                    <li>{{$mainQuestion->title}}</li>
                </ul>
                <div class="boxDetails">
                    <div class="headBox">
                        <h1 class="globalTitle globalTitle3">
                            <a href="{{url('hoi-dap', $mainQuestion->slug)}}">{{$mainQuestion->title}}</a>
                        </h1>
                    </div>
                    {!! $mainQuestion->answer !!}
                </div>
                <div class="boxLike">
                    <div class='fb-like' data-action='like' data-href='{{url('hoi-dap', $mainQuestion->slug)}}' data-layout='button_count' data-share='true' data-show-faces='false' data-width='520'></div>
                </div>

                <div>
                    <!-- //listButton -->
                    <ul class="listButton clearFix">
                        <li class="ilocal"><a href="{{url('phan-phoi')}}">XEM ĐIỂM BÁN SẢN PHẨM</a></li>
                        <li class="icall"><a href="{{url('lien-he')}}">1900 6482 - 0912 571 190</a></li>
                    </ul>
                </div>
                <br />

                <div class="boxComment">
                    <div class="fb-comments" data-href="{{url('hoi-dap', $mainQuestion->slug)}}" data-numposts="5"></div>
                </div>

                @foreach (\App\Site::getFrontendBanners()->where('position_id', 6) as $banner)
                    <div class="boxAdv">
                        <a href="{{$banner->link}}" title="adv">
                            <img src="{{url('files', $banner->image)}}" alt="ADV">
                        </a>
                    </div>
                @endforeach
                <div class="boxNews">
                    <h3 class="globalTitle"><a href="{{url('tin-tuc')}}">Tin mới nhất</a></h3>
                    <div class="listNews clearFix boxHotNews">
                        @foreach (\App\Site::getLatestNews() as $post)
                            <div class="item">
                                <a href="{{url($post->slug.'.html')}}" class="thumb">
                                    <img src="{{url('img/cache/188x125', $post->image)}}" alt="List news" width="232" height="159">
                                </a>
                                <p>
                                    <a href="{{url($post->slug.'.html')}}">{{$post->title}}</a>
                                </p>
                                <span class="datePost">{{$post->updated_at->format('d/m/Y')}}</span>
                                <span class="countView">{{$post->views}} lượt xem</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('frontend.right')
        </div>
    </section>
@endsection