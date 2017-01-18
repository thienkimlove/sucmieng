@extends('frontend.template')

@section('content')
    <section class="section section1">
        <div class="container">
            @include('frontend.intro')
        </div>
    </section>
    <section class="boxSlidePage bg">
        <div class="container">
            <h3 class="noneAfter">
                <a href="javascript:void(0)"><span></span></a>
            </h3>
            <div class="listSlidePage clearFix">
                <div class="owl-carousel" id="slidePage">
                    @foreach ($sliderPosts as $post)
                        <div class="item wow slideInLeft" data-wow-duration="0.8s" data-wow-delay="1s">
                        <a href="{{url($post->slug.'.html')}}" title="{{$post->title}}">
                            <img src="{{url('img/cache/274x174', $post->image)}}" width="274" height="174" alt=""/>
                        </a>
                        <h3>
                            <a href="{{url($post->slug.'.html')}}">
                                {{$post->title}}
                            </a>
                        </h3>
                        <p>
                            {{str_limit($post->desc, env('DESC_LIMIT'))}}
                        </p>
                        <div class="bg-bottom"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="section section2 mb0">
        <div class="container">
            <div class="contentLeft">
                <div class="boxNews clearFix">
                    <h3 class="globalTitle"><a href="{{url('tin-tuc')}}" target="_blank">Tin mới nhất</a></h3>
                    <div class="listNews clearFix">
                        @foreach (\App\Site::getLatestIndexPosts() as $post)
                          <div class="item">
                            <a href="{{url($post->slug.'.html')}}" class="thumb">
                                <img src="{{url('img/cache/257x171', $post->image)}}" alt="List news">
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
                <div class="boxConsult">
                    <div class="titleConsult">
                        <h3 class="globalTitle">
                            <a href="{{url('hoi-dap')}}">Góc chuyên gia</a>
                        </h3>
                    </div>
                    <p>
                        PGS. TS. Nguyễn Văn A - Trưởng khoa sản, bệnh viện nhi Trung ương - Chuyên gia đầu ngành dinh dưỡng sản khoa.
                        PGS. TS. Nguyễn Văn A - Trưởng khoa sản, bệnh viện nhi Trung ương - Chuyên gia đầu ngành dinh dưỡng sản khoa.
                        PGS. TS. Nguyễn Văn A - Trưởng khoa sản, bệnh viện nhi Trung ương - Chuyên gia đầu ngành dinh dưỡng sản khoa.
                    </p>
                </div>
                <div class="boxQuestion clearFix">
                    <div class="areaAvatar">
                        <div class="areaAsk">
                            <a href="javascript:void(0)" class="btnAsk">Đặt câu hỏi tại đây</a>
                        </div>
                        <img src="{{url('frontend/images/bg/avatar.png')}}" alt="" width="268" height="318">
                    </div>
                    <div class="areaQuestion">
                        <ul class="listQuestion" id="listQuestion">
                            @foreach (\App\Site::getLatestQuestions() as $question)
                                <li><a href="{{url('hoi-dap', $question->slug)}}">{{$question->title}}</a></li>
                            @endforeach
                        </ul>
                        <a href="{{url('hoi-dap')}}" class="view-more">Xem thêm</a>
                    </div>
                </div>
            </div>
            ﻿@include('frontend.right_index')
        </div>
    </section>
@endsection