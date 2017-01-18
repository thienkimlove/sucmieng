<!DOCTYPE html>
<html lang="vi">
<head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <link rel="stylesheet" href="{{url('frontend/css/style.css')}}" type="text/css"/>
    <title>{{$meta_title}}</title>

    <meta property="og:title" content="{{$meta_title}}">
    <meta property="og:description" content="{{$meta_desc}}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{$meta_url}}">
    <meta property="og:image" content="{{$meta_image}}">
    <meta property="og:site_name" content="{{env('SITE_NAME')}}">
    <meta property="fb:app_id" content="{{env('FB_ID')}}" />

    <meta name="twitter:card" content="Card">
    <meta name="twitter:url" content="{{$meta_url}}">
    <meta name="twitter:title" content="{{$meta_title}}">
    <meta name="twitter:description" content="{{$meta_desc}}">
    <meta name="twitter:image" content="{{$meta_image}}">


    <meta itemprop="name" content="{{$meta_title}}">
    <meta itemprop="description" content="{{$meta_desc}}">
    <meta itemprop="image" content="{{$meta_image}}">

    <meta name="ABSTRACT" content="{{$meta_desc}}"/>
    <meta http-equiv="REFRESH" content="1200"/>
    <meta name="REVISIT-AFTER" content="1 DAYS"/>
    <meta name="DESCRIPTION" content="{{$meta_desc}}"/>
    <meta name="KEYWORDS" content="{{$meta_keywords}}"/>
    <meta name="ROBOTS" content="index,follow"/>
    <meta name="AUTHOR" content="{{env('SITE_NAME')}}"/>
    <meta name="RESOURCE-TYPE" content="DOCUMENT"/>
    <meta name="DISTRIBUTION" content="GLOBAL"/>
    <meta name="COPYRIGHT" content="Copyright 2013 by Goethe"/>
    <meta name="Googlebot" content="index,follow,archive" />
    <meta name="RATING" content="GENERAL"/>
    <![if !IE]>
    <script src="{{url('frontend/js/html5.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{url('frontend/css/all-ie-only.css')}}" />
    <![endif]-->
    <script src="{{url('frontend/js/modernizr.js')}}" type="text/javascript"></script>
</head>

<body>
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '{{env('FB_ID')}}',
            xfbml      : true,
            version    : 'v2.8'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@if (isset($page) && $page != 'index')
    <div class="banner-ads left">
        @foreach (\App\Site::getFrontendBanners()->where('position_id', 2) as $banner)
            <a href="{{$banner->link}}" title="Tên quảng cáo">
                <img src="{{url('files', $banner->image)}}" alt="" width="169" height="487">
            </a>
        @endforeach
    </div>
    <div class="banner-ads right">
        @foreach (\App\Site::getFrontendBanners()->where('position_id', 3) as $banner)
            <a href="{{$banner->link}}" title="Tên quảng cáo">
                <img src="{{url('files', $banner->image)}}" alt="" width="169" height="487">
            </a>
        @endforeach
    </div>
@endif

@include('frontend.header')
<section class="boxBanner">
    <div class="boxSlider">
        <div class="owl-carousel" id="slideIndex">
            @foreach (\App\Site::getFrontendBanners()->where('position_id', 1) as $banner)
                <div class="item">
                    <a class="thumb" href="{{$banner->link}}" title="">
                        <img src="{{url('files', $banner->image)}}" width="1920" height="578"/>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!--//box-Banner-->
</section>
@yield('content')
﻿
@include('frontend.footer')

<script type="text/javascript" src="{{url('frontend/js/jquery-1.10.2.min.js')}}"></script>
<script type="text/javascript" src="{{url('frontend/js/SmoothScroll.js')}}"></script>
<script type="text/javascript" src="{{url('frontend/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{url('frontend/js/owl.carousel.js')}}"></script>
<script type="text/javascript" src="{{url('frontend/js/scrollReveal.js')}}"></script>
<script src="{{url('frontend/js/jquery.easing.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{url('frontend/js/common.min.js')}}"></script>
@yield('script')
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-84352576-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>