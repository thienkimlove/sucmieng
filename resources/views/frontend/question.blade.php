@extends('frontend.template')

@section('content')
    <section class="section vis">
        <div class="container">
            <div class="contentLeft">
                <ul class="breadCrumb clearFix">
                    <li><a href="{{url('/')}}">TRANG CHỦ</a></li>
                    <li class="active">HỎI ĐÁP</li>
                </ul>
                <div class="boxNews clearFix">
                    <h3 class="globalTitle globalTitle3">
                        <a href="{{url('hoi-dap')}}" title="Hỏi đáp chuyên gia">HỎI ĐÁP CHUYÊN GIA</a>
                    </h3>
                    <div class="boxHead">
                        <div class="boxHead1">
                            <img src="{{url('frontend/images/bg/avatar.png')}}" alt="" width="268" height="318" class="imgFull">
                        </div>
                        <div class="boxHead2">
                            PGS. TS. Nguyễn Văn A - Trưởng khoa sản, bệnh viện nhi Trung ương - Chuyên gia đầu ngành dinh dưỡng sản khoa.
                            PGS. TS. Nguyễn Văn A - Trưởng khoa sản, bệnh viện nhi Trung ương - Chuyên gia đầu ngành dinh dưỡng sản khoa.
                            PGS. TS. Nguyễn Văn A - Trưởng khoa sản, bệnh viện nhi Trung ương - Chuyên gia đầu ngành dinh dưỡng sản khoa.
                        </div>
                    </div>
                    <div class="listNews fullWidth cam-nang-news">
                        @foreach ($questions as $question)
                           <div class="item clearFix">
                            <h3><a href="{{url('hoi-dap', $question->slug)}}" class="title">{{$question->title}}</a></h3>
                            <a href="{{url('hoi-dap', $question->slug)}}" class="thumb">
                                <img src="{{url('img/cache/320x180', $question->image)}}" alt="{{$question->title}}" width="320" height="180">
                            </a>
                            <p>
                                {{$question->desc}}
                            </p>
                            <a href="{{url('hoi-dap', $question->slug)}}" class="readMore">Chi tiết</a>
                        </div>
                        @endforeach
                        <!-- /paging -->
                        <div class="boxPaging">
                            @include('frontend.pagination', ['paginate' => $questions])
                        </div>
                    </div>
                </div>
                <!-- /endboxNews -->
            </div>
            @include('frontend.right')
        </div>
    </section>
@endsection