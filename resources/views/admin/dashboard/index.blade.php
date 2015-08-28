@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}
@section('main')

<div class="page-header">
    <h3>
        {{$title}}
    </h3>
</div>

<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-user fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$users}}</div>
                        <div>{{ Lang::get("admin/admin.users") }}!</div>
                    </div>
                </div>
            </div>
            <a href="{{URL::to('admin/users')}}">
                <div class="panel-footer">
                    <span class="pull-left">{{ Lang::get("admin/admin.view_detail") }}</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">


    </div>
    <div class="col-lg-3 col-md-6">


    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-users"></i> Recent Users</h3>
            </div>
            <div class="panel-body">
                
                <ul class="list-group">
                    <?php $i=1; ?>
                    @foreach($lastUsers as $lastUser)
                    <li class="list-group-item">{{$i . '. ' .$lastUser->name . ' ' . $lastUser->last_name}}</li>
                    <?php $i++; ?>
                    @endforeach
                </ul>
                
            </div>
        </div>
    </div>
</div>
@endsection
