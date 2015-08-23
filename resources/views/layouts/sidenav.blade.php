@extends('app')
@section('content')
    <div class="row">
            @yield('top')
    </div>
    <div class="row">
       
        {{--<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">--}}
        <div class="col-sm-10 col-md-12 main">
            @yield('main')
        </div>
    </div>
@endsection
