@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Welcome {{$user->email}}.
                </div>
            </div>

        </div>
    </div>
@endsection