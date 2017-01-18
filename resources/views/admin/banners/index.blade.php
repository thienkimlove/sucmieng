@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Banners</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ảnh</th>
                                <th>Vị trí</th>
                                <th>URL</th>
                                <th>Hành động</th>

                                @if (isset(config('site.content')[$model]['modules']) && config('site.content')[$model]['modules'])
                                    @foreach (config('site.content')[$model]['modules'] as $k => $module)
                                        <th>{{$module}}</th>
                                    @endforeach
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contents as $content)
                                <tr>
                                    <td>{{$content->id}}</td>
                                    <td><img src="{{url('img/cache/small', $content->image)}}" /></td>
                                    <td>{{$content->position->name}}</td>
                                    <td>{{$content->link}}</td>
                                    <td>
                                        <button id-attr="{{$content->id}}"
                                                content-attr="{{$model}}"
                                                class="btn btn-primary btn-sm edit-content"
                                                type="button">
                                            Sửa
                                        </button>&nbsp;
                                        {!! Form::open(['method' => 'DELETE', 'route' => [$model.'.destroy', $content->id]]) !!}
                                        <button type="submit" class="btn btn-danger btn-mini">Xóa</button>
                                        {!! Form::close() !!}
                                    </td>

                                    @if (isset(config('site.content')[$model]['modules']) && config('site.content')[$model]['modules'])
                                        @foreach (config('site.content')[$model]['modules'] as $k => $module)
                                            <td>
                                                @if ($enabled = \App\Site::moduleEnable($k, $model, $content->id))
                                                    {!! Form::open(['method' => 'DELETE', 'url' => url('admin/modules/'.$enabled->id)]) !!}
                                                    <button type="submit" class="btn btn-danger btn-mini">Bật</button>
                                                    <input type="hidden" name="redirect_back" value="{{Request::url()}}" />
                                                    {!! Form::close() !!}
                                                @else
                                                    {!! Form::open(['method' => 'POST', 'url' => url('admin/modules')]) !!}
                                                    <input type="hidden" name="key_name" value="{{$module}}" />
                                                    <input type="hidden" name="key_type" value="{{$k}}" />
                                                    <input type="hidden" name="key_content" value="{{$model}}" />
                                                    <input type="hidden" name="key_value" value="{{$content->id}}" />
                                                    <input type="hidden" name="redirect_back" value="{{Request::url()}}" />
                                                    <button type="submit" class="btn btn-danger btn-mini">Tắt</button>
                                                    {!! Form::close() !!}
                                                @endif
                                            </td>
                                        @endforeach
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="row">

                        <div class="col-sm-6">{!!$contents->render()!!}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-primary add-content" content-attr="{{$model}}" type="button">Thêm mới</button>
                        </div>
                    </div>


                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

    </div>
@endsection
@section('footer')
    <script>
        $(function(){
            $('.add-content').click(function(){
                window.location.href = window.baseUrl + '/admin/'+$(this).attr('content-attr')+'/create';
            });
            $('.edit-content').click(function(){
                window.location.href = window.baseUrl + '/admin/'+$(this).attr('content-attr')+'/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection