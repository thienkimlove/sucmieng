@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Questions</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            @if ($content->id)
                <h2>Chỉnh sửa</h2>
                {!! Form::model($content, ['method' => 'PATCH', 'route' => [$model.'.update', $content->id], 'files' => true]) !!}
            @else
                <h2>Thêm mới</h2>
                {!! Form::model($content, ['route' => [$model.'.store'], 'files' => true]) !!}
            @endif
                <div class="form-group">
                    {!! Form::label('image', 'Ảnh đại diện cho cau hoi') !!}
                    @if ($content->image)
                        <img src="{{url('img/cache/120x120/' . $content->image)}}" />
                        <hr>
                    @endif
                    {!! Form::file('image', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('title', 'Tiêu đề câu hỏi ') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('seo_title', 'SEO Title') !!}
                    {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
                </div>




                <div class="form-group">
                    {!! Form::label('question', 'Câu hỏi') !!}
                    {!! Form::textarea('question', null, ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('desc', 'SEO Description') !!}
                    {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('keywords', 'SEO Keywords') !!}
                    {!! Form::textarea('keywords', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('ask_person', 'Người đặt câu hỏi ') !!}
                    {!! Form::text('ask_person', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('ask_phone', 'Phone') !!}
                    {!! Form::text('ask_phone', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('ask_address', 'Address') !!}
                    {!! Form::text('ask_address', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('ask_email', 'Email') !!}
                    {!! Form::text('ask_email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('answer_person', 'Nguoi tra loi') !!}
                    {!! Form::text('answer_person', null, ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('answer', 'Câu trả lời') !!}
                    {!! Form::textarea('answer', null, ['class' => 'form-control']) !!}
                </div>


            <div class="form-group">
                {!! Form::label('status', 'Status') !!}
                {!! Form::select('status', \App\Site::getStatus(), null, ['class' => 'form-control']) !!}
            </div>

             <div class="form-group">
                {!! Form::submit('Lưu', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}

            @include('admin.list')

        </div>
    </div>
@endsection
