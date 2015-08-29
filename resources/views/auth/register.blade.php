@extends('appLogin')

{{-- Web site Title --}}
@section('title') {{{ Lang::get('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')

<div class="row vertical-offset-100">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div align="center" class="panel-heading">
                <h3 class="panel-title">Register</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/auth/register') !!}">
                
                <div class="modal-body">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- FIST NAME -->
                    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label class="col-md-4 control-label">{{{ Lang::get('site/user.first_name')}}}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            {!! $errors->first('name', '<span class="help-block error">:message</span>')!!}
                        </div>
                        

                    </div>                           

                    <!-- LAST NAME -->
                    <div class="form-group {{{ $errors->has('last_name') ? 'has-error' : '' }}}">
                        <label class="col-md-4 control-label">{{{ Lang::get('site/user.last_name')}}}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="last_name"
                                   value="{{ old('last_name') }}">
                            {!! $errors->first('last_name', '<span class="help-block error">:message</span>')!!}
                        </div>
                    </div>
                    <!-- STREET -->
                    <div class="form-group {{{ $errors->has('street') ? 'has-error' : '' }}}">
                        <label class="col-md-4 control-label">{{{ Lang::get('site/user.street')}}}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="street"
                                   value="{{ old('street') }}">
                            {!! $errors->first('street', '<span class="help-block error">:message</span>')!!}
                        </div>
                    </div>
                    <!-- CITY -->
                    <div class="form-group {{{ $errors->has('city') ? 'has-error' : '' }}}">
                        <label class="col-md-4 control-label">{{{ Lang::get('site/user.city')}}}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="city"
                                   value="{{ old('city') }}">
                            {!! $errors->first('city', '<span class="help-block error">:message</span>')!!}
                        </div>
                    </div>

                    <!-- PHONE  -->
                    <div class="form-group {{{ $errors->has('phone') ? 'has-error' : '' }}}">
                        <label class="col-md-4 control-label">{{{ Lang::get('site/user.phone')}}}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone"
                                   value="{{ old('phone') }}">
                            {!! $errors->first('phone', '<span class="help-block error">:message</span>')!!}
                        </div>
                    </div>
                    <!-- EMAIL  -->
                    <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                        <label class="col-md-4 control-label">{{{ Lang::get('site/user.e_mail') }}}</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            {!! $errors->first('email', '<span class="help-block error">:message</span>')!!}
                        </div>
                    </div>
                    <!-- PASSWORD  -->
                    <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
                        <label class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                            {!! $errors->first('password', '<span class="help-block error">:message</span>')!!}
                        </div>
                    </div>
                    <!-- CONFIRM PASSWORD  -->
                    <div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
                        <label class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation">
                            {!! $errors->first('password_confirmation', '<span class="help-block error">:message</span>')!!}
                        </div>
                    </div>
                    <!-- CODE  -->
                    <div class="form-group  {{{ $errors->has('code') ? 'has-error' : '' }}}">
                        <label class="col-md-4 control-label">{{ Lang::get("site/user.registration_key") }}</label>
                        <div class="col-md-6 code">
                            @for($i=0; $i<5; $i++)
                            <input  size="1" maxlength="1" type="text" class="form-control key" name="code[{{$i}}]">
                            {!! $errors->first('code.'.$i, '<br/><span class="help-block error">:message</span>')!!}
                            @endfor
                            <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="bottom" title='{{Lang::get("site/site.tooltip")}}'><i>info</i></button>
                            
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <a href="{{url('/')}}" class="btn btn-default" data-dismiss="modal">Back</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Register</button>

                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
