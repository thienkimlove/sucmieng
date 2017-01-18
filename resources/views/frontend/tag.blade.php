@extends('frontend.template')

@section('content')
    <section class="section vis">
        <div class="container">
            <div class="contentLeft">
                <ul class="breadCrumb clearFix">
                    <li><a href="{{url('/')}}">TRANG CHỦ</a></li>
                    <li class="active">Từ khóa : {{strtoupper($tag->title)}}</li>
                </ul>
                <div class="boxNews clearFix">
                    <h3 class="globalTitle globalTitle3">
                        <a href="{{url('tu-khoa', $tag->slug)}}" title="{{$tag->title}}">Từ khóa : {{strtoupper($tag->title)}}</a>
                    </h3>
                    <div class="listNews fullWidth cam-nang-news">
                        @foreach ($posts as $post)
                            <div class="item clearFix">
                                <h3><a href="{{url($post->slug.'.html')}}" class="title">{{$post->title}}</a></h3>
                                <a href="#" class="thumb">
                                    <img src="{{url('img/cache/320x180', $post->image)}}" alt="List news" width="320" height="180">
                                </a>
                                <p>
                                   {{$post->desc}}
                                </p>
                                <a href="{{url($post->slug.'.html')}}" class="readMore">Chi tiết</a>
                            </div>
                        @endforeach
                        <!-- /paging -->
                        <div class="boxPaging">
                            @include('frontend.pagination', ['paginate' => $posts])
                        </div>
                    </div>
                </div>
                <!-- /endboxNews -->
            </div>
            ﻿@include('frontend.right')
        </div>
    </section>
@endsection