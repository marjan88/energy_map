@extends('app')

{{-- Web site Title --}}
@section('title') {{{ Lang::get('site/user.login') }}} :: @parent @stop

{{-- Content --}}
@section('content')
<div class="row">
    <div align="center" class="page-header">
        <h2>{{{ Lang::get('site/user.login_to_account') }}}</h2>
    </div>
</div>

<div align="center" class="container-fluid">
    <div  class="row">
        {{--<div class="col-md-8 col-md-offset-2">--}}
        {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading">Login</div>--}}
        {{--<div class="panel-body">--}}

        @include('errors.list')

        <form  class="form-horizontal" role="form" method="POST" action="{!! URL::to('/auth/login') !!}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div  class="form-group">

                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input placeholder="Email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div  class="form-group">                            
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input placeholder="Password" type="password" class="form-control" name="password">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="form-group">

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                    Login
                </button>  
            </div>
            <div class="form-group">
                <a href="{!! URL::to('/password/email') !!}">Forgot Your Password?</a>
            </div>


    </div>

</form>
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
</div>
</div>
@endsection
