@extends('frontend.template')

@section('content')
    <section class="section vis">
        <div class="container">
            <div class="contentLeft">
                <ul class="breadCrumb clearFix">
                    <li><a href="{{url('/')}}">TRANG CHỦ</a></li>
                    <li class="active">LIÊN HỆ</li>
                </ul>
                <div class="boxContact">
                    <div class="boxForm">
                        <div class="boxConsult clearFix">
                            <form action="{{url('saveContact')}}" method="post" class="formConsult">
                                <input type="text" name="title" class="subject txt" placeholder="Tiêu đề">
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                <div class="inline">
                                    <input type="text" name="name" placeholder="Họ và tên" class="txt txtName">
                                    <input type="text" name="email" placeholder="Địa chỉ email" class="txt txtMail">
                                </div>
                                <textarea name="content" class="txt txtArea" placeholder="Nội dung"></textarea>
                                <input type="reset" value="Hủy" class="btnReset">
                                <input type="submit" value="Gửi yêu cầu" class="btnSubmit">
                            </form>
                        </div>
                    </div>
                    <div class="item address">
                        <h3 class="globalTitle globalTitle3">
                            <a href="{{url('lien-he')}}">Liên hệ</a>
                        </h3>
                        <div class="addContent">
                            <strong>Công ty TMHH Tuệ Linh chi nhánh Hà Nội</strong> <br>
                            <span class="icon-address">Địa chỉ: Tầng 5 tòa nhà 29T1,phố Hoàng Đạo Thúy, Trung Hòa, Cầu Giấy, Hà Nội </span>
                            <span class="icon-phone">ĐT: 04.62824344</span>
                            <span class="icon-fax">Fax: 04.62824263</span>
                            <span class="icon-mail"><a href="mailto:info@tuelinh.com">info@tuelinh.com</a></span>
                        </div>
                        <div class="addContent">
                            <strong>Công ty TMHH Tuệ Linh chi nhánh TP. HCM</strong> <br>
                            <span class="icon-address">Địa chỉ:156/17 Tô Hiến Thành. P15 Q10, TP.HCM</span>
                            <span class="icon-phone">083.9797779</span>
                            <span class="icon-fax">086.2646832</span>
                            <span class="icon-mail"><a href="mailto:info@tuelinh.com">info@tuelinh.com</a></span>
                        </div>
                    </div>
                    <div class="boxMap">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14898.483493048278!2d105.8014624!3d21.007829299999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab5a02fbb0f5%3A0x75b5e966c9fb8bc0!2zQ8O0bmcgdHkgVE5ISCBUdeG7hyBMaW5o!5e0!3m2!1svi!2s!4v1441615369587" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            @include('frontend.right')
        </div>
    </section>
@endsection