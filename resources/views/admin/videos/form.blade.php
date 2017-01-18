@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Video</h1>
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
                {!! Form::label('title', 'Tên Video') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>



            <div class="form-group">
                {!! Form::label('seo_title', 'Tên Video (SEO)') !!}
                {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
            </div>

                <div class="form-group">
                    {!! Form::label('link', 'Link Video') !!}
                    {!! Form::text('link', null, ['class' => 'form-control']) !!}
                </div>

            <div class="form-group">
                {!! Form::label('desc', 'Mô tả ngắn (Dùng cho phần Meta Description)') !!}
                {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('keywords', 'Các từ khóa (Dùng cho phần Meta Keywords)') !!}
                {!! Form::textarea('keywords', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('content', 'Nội dung Video') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control ckeditor']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Ảnh Video') !!}
                @if ($content->image)
                    <img src="{{url('img/cache/small/' . $content->image)}}" />
                    <hr>
                @endif
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tag_list', 'Từ khóa') !!}
                {!! Form::select('tag_list[]', \App\Tag::pluck('title', 'title')->all(), null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
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

@section('footer')
    <script>
        $('#tag_list').select2({
            placeholder : 'choose or add new tag',
            tags : true //allow to add new tag which not in list.
        });
    </script>
@endsection