<header class="header">
    <div class="container">
        <h1 class="clearFix logosp">
            <a href="{{url('/')}}" class="logo" title="Logo">
                <img src="{{url('frontend/images/logo.png')}}" alt="{{env('SITE_NAME')}}" width="160" height="82" class="pc">
            </a>
        </h1>
        <ul id="globalNav" class="pc animated">
            <li><a href="{{url('/')}}" class="{{(isset($page) && $page == 'index') ? 'active' : ''}}">Trang chủ</a></li>
            <li>
                <a href="{{url('cam-nang')}}" class="{{(isset($page) && $page == 'cam-nang') ? 'active' : ''}}">Cẩm nang</a>
                <ul>
                    @foreach (\App\Site::getSubCategories('cam-nang')->subCategories as $sub)
                       <li><a href="{{url($sub->slug)}}">{{$sub->title}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="{{url('san-pham')}}" class="{{(isset($page) && $page == 'san-pham') ? 'active' : ''}}">Sản phẩm</a>
            </li>
            <li>
                <a href="{{url('tin-tuc')}}" class="{{(isset($page) && $page == 'tin-tuc') ? 'active' : ''}}">Tin tức</a>
                <ul>
                    @foreach (\App\Site::getSubCategories('tin-tuc')->subCategories as $sub)
                        <li><a href="{{url($sub->slug)}}">{{$sub->title}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{url('video')}}" class="{{(isset($page) && $page == 'video') ? 'active' : ''}}">Video</a></li>
            <li><a href="{{url('hoi-dap')}}" class="{{(isset($page) && $page == 'hoi-dap') ? 'active' : ''}}">Hỏi đáp</a></li>
            <li><a href="{{url('phan-phoi')}}" class="{{(isset($page) && $page == 'phan-phoi') ? 'active' : ''}}">Phân phối</a></li>
            <li><a href="{{url('lien-he')}}" class="{{(isset($page) && $page == 'lien-he') ? 'active' : ''}}">Liên hệ</a></li>
        </ul>
        <a href="#" title="Menu" class="sp btnMenu" id="btnMenu">Menu</a>
    </div>
</header>