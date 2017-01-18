@extends('frontend.template')

@section('content')
    <section class="section vis">
        <div class="container">
            <div class="contentLeft">
                <ul class="breadCrumb clearFix">
                    <li><a href="{{url('/')}}">TRANG CHỦ</a></li>
                    <li class="active">PHÂN PHỐI</li>
                </ul>
                <div class="boxContact">
                    <div class="boxDist">
                        <h3 class="globalTitle globalTitle3">
                            <a href="{{url('phan-phoi')}}">Hệ thống phân phối</a>
                        </h3>
                        <form action="" id="searchProduct">
                            <label for="">TÌM KIẾM THEO</label>
                            <div class="form-timsp">
                                <select name="" id="byProvine">
                                    <option value="0">Chọn tỉnh, thành phố...</option>
                                    @foreach (config('delivery')['city'] as $id => $city)
                                        <option value="{{$id}}">{{$city}}</option>
                                    @endforeach
                                </select>
                                <button id="searchPro"><img src="{{url('frontend/images/bg/icon-search.png')}}" alt="" width="30" height="27"></button>
                            </div>
                        </form>
                        @foreach ($totalDeliveries as $area => $cities)
                            <div class="places">
                                <span class="captain">{{$area}}</span>
                                <div class="provines">
                                    @foreach ($cities->chunk(6) as $partCities)
                                        @foreach ($partCities as $city)
                                            <a href="{{url('phan-phoi/'. $city->id)}}" title="">{{config('delivery')['city'][$city->city]}}</a>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            ﻿@include('frontend.right')
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#searchPro').click(function(e){
                e.preventDefault();
                var cityId = $('#byProvine').val();
                window.location.href ='/phan-phoi/' + cityId;
            })
        });
    </script>
@endsection