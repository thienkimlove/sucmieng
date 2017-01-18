<div class="contentRight">
            <span class="hotline">
                <img src="{{url('frontend/images/hot.png')}}" alt="Hotline" class="imgFull" width="852" height="133">
            </span>
    @if ($rightIndexVideos = \App\Site::getRightIndexVideos())
    <div class="boxVideo">
        <h3 class="globalTitle globalTitle2">
            <a href="{{url('video')}}">Góc Video</a>
        </h3>
        <div class="content">
            @if ($firstVideo = $rightIndexVideos->shift())
            <div class="video-wrapper">
                <iframe width="100%" height="160" src="{{$firstVideo->url}}" frameborder="0" allowfullscreen></iframe>
            </div>
            @endif
            @if ($rightIndexVideos->count() > 0)
            <ul class="listVideo">
                @foreach($rightIndexVideos as $rightVideo)
                <li>
                    <a href="{{url('video', $rightVideo->slug)}}">
                        <img src="{{url('img/cache/115x68', $rightVideo->image)}}" alt="" width="115" height="68">{{$rightVideo->title}}
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
    @endif
    <div class="boxSale">
        <h3 class="globalTitle globalTitle2">
            <a href="#">Cộng đồng mẹ thông thái</a>
        </h3>
        <div class="Social">
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D331941750220018%26fref%3Dts&tabs=timeline&width=300&height=225&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="263" height="156" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </div>
    </div>
</div>