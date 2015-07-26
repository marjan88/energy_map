@extends('appLogin')

{{-- Web site Title --}}
@section('title') {{{ Lang::get('site/user.login') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="row vertical-offset-100">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div align="center" class="panel-heading">
                <h3 class="panel-title">Sign in</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="{!! URL::to('/auth/login') !!}" accept-charset="UTF-8" role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                            <input class="form-control" placeholder="E-mail" name="email" type="text" value="{{ old('email') }}">
                            {!! $errors->first('email', '<span class="help-block error">:message</span>')!!}
                        </div>
                        <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            {!! $errors->first('password', '<span class="help-block error">:message</span>')!!}
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                            </label>
                        </div>
                        <input class="btn  btn-info btn-block" type="submit" value="Login">
                        <a href="{{url('auth/register')}}" class="btn btn-primary  btn-block">
                            <i class="fa fa-sign-in"></i>  Register
                        </a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
