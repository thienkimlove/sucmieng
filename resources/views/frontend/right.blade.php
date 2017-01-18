<div class="contentRight">
    @foreach (\App\Site::getFrontendBanners()->where('position_id', 4) as $banner)
    <div class="banner-right banner1">
        <a href="{{$banner->link}}">
            <img src="{{url('files', $banner->image)}}" alt="Banner" class="imgFull" width="360" height="267">
        </a>
    </div>
    @endforeach
    <div class="boxSale">
        <h3 class="globalTitle globalTitle2">
            <a href="#">Cộng đồng mẹ thông thái</a>
        </h3>
        <div class="Social">
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D331941750220018%26fref%3Dts&tabs=timeline&width=300&height=225&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="263" height="156" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </div>
    </div>
    <div class="banner-right banner2">
        @foreach (\App\Site::getFrontendBanners()->where('position_id', 5) as $banner)
            <a href="{{$banner->link}}">
                <img src="{{url('files', $banner->image)}}" alt="Banner" class="imgFull" width="360" height="116">
            </a>
        @endforeach
    </div>
    <div class="boxHot clearFix" id="sidebar">
        <h3 class="globalTitle"><a href="{{url('tin-tuc')}}">Tin nổi bật</a></h3>
        @foreach (\App\Site::getRightFeaturePosts($page) as $post)
        <div class="item clearFix">
            <a href="{{url($post->slug.'.html')}}" class="thumb">
                <img src="{{url('img/cache/100x80', $post->image)}}" alt="hot" width="100" height="80">
            </a>
            <h4>
                <a href="{{url($post->slug.'.html')}}">{{$post->title}}</a>
            </h4>
        </div>
        @endforeach
    </div>

</div>