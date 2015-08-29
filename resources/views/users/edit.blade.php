@extends('app')

@section('title') Profile Edit :: @parent @stop

@section('content')
@include('notifications')

<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        @include('users.partials.nav')
    </div>    
    <div class="col-sm-9 col-md-10 main">
        <div class="page-header">
            <h3>
                Profil bearbeiten
                <div class="pull-right">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-default" href="{{ url('admin/users')}}"><span class="glyphicon glyphicon-backward"></span> Back</a>
                    </div>
                </div>
            </h3>
        </div>



        <form class="form-horizontal" style="margin-top: 20px" method="post"
              action="@if (isset($user)){{ URL::to('user/profile/' . $user->id . '/edit') }}@endif"
              autocomplete="off">

            <!-- _token -->
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

            <div class="tab-content">
                <div class="tab-pane active" id="tab-general">

                    <!--FIRST NAME  -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="name">{{
						Lang::get('admin/users.name') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" tabindex="1"
                                       placeholder="{{ Lang::get('admin/users.name') }}" type="text"
                                       name="name" id="name"
                                       value="{{{ Input::old('name', isset($user) ? $user->name : null) }}}">
                            </div>
                        </div>
                    </div>
                    <!--LAST NAME  -->
                    <div class="col-md-12">
                        <div class="form-group {{{ $errors->has('last_name') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="last_name">{{
						Lang::get('admin/users.last_name') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="last_name" tabindex="4"
                                       placeholder="{{ Lang::get('admin/users.last_name') }}" name="last_name"
                                       id="last_name"
                                       value="{{{ Input::old('last_name', isset($user) ? $user->last_name : null) }}}" />
                                {!! $errors->first('last_name', '<label class="control-label"
                                                                        for="last_name">:message</label>')!!}
                            </div>
                        </div>
                    </div>
                    <!-- EMAIL  -->
<!--                    <div class="col-md-12">
                        <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="email">{{
						Lang::get('admin/users.email') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="email" tabindex="4"
                                       placeholder="{{ Lang::get('admin/users.email') }}" name="email"
                                       id="email"
                                       value="{{{ Input::old('email', isset($user) ? $user->email : null) }}}" />
                                {!! $errors->first('email', '<label class="control-label"
                                                                    for="email">:message</label>')!!}
                            </div>
                        </div>
                    </div>-->

                    <!-- STREET -->
                    <div class="col-md-12">
                        <div class="form-group {{{ $errors->has('street') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="street">{{
						Lang::get('admin/users.street') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="street" tabindex="4"
                                       placeholder="{{ Lang::get('admin/users.street') }}" name="street"
                                       id="street"
                                       value="{{{ Input::old('street', isset($user) ? $user->street : null) }}}" />
                                {!! $errors->first('street', '<label class="control-label"
                                                                     for="street">:message</label>')!!}
                            </div>
                        </div>
                    </div>

                    <!-- PHONE -->
                    <div class="col-md-12">
                        <div class="form-group {{{ $errors->has('phone') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="phone">{{
						Lang::get('admin/users.phone') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="phone" tabindex="4"
                                       placeholder="{{ Lang::get('admin/users.phone') }}" name="phone"
                                       id="phone"
                                       value="{{{ Input::old('phone', isset($user) ? $user->phone : null) }}}" />
                                {!! $errors->first('phone', '<label class="control-label"
                                                                    for="phone">:message</label>')!!}
                            </div>
                        </div>
                    </div>

                    <!-- CITY -->
                    <div class="col-md-12">
                        <div class="form-group {{{ $errors->has('city') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="city">{{
						Lang::get('admin/users.city') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="city" tabindex="4"
                                       placeholder="{{ Lang::get('admin/users.city') }}" name="city"
                                       id="city"
                                       value="{{{ Input::old('city', isset($user) ? $user->city : null) }}}" />
                                {!! $errors->first('city', '<label class="control-label"
                                                                   for="city">:message</label>')!!}
                            </div>
                        </div>
                    </div>

                    <!-- password -->
                    <div class="col-md-12">
                        <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="password">{{
						Lang::get('admin/users.password') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" tabindex="5"
                                       placeholder="{{ Lang::get('admin/users.password') }}"
                                       type="password" name="password" id="password" value="" />
                                {!!$errors->first('password', '<label class="control-label"
                                                                      for="password">:message</label>')!!}
                            </div>
                        </div>
                    </div>

                    <!-- password_confirmation -->

                    <div class="col-md-12">
                        <div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="password_confirmation">{{
                                                                    Lang::get('admin/users.password_confirmation') }}</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" tabindex="6"
                                       placeholder="{{ Lang::get('admin/users.password_confirmation') }}"
                                       name="password_confirmation" id="password_confirmation" value="" />
                                {!!$errors->first('password_confirmation', '<label
                                    class="control-label" for="password_confirmation">:message</label>')!!}
                            </div>
                        </div>
                    </div>




                    <div class="col-md-12">
                        <br>
                    </div>

                    <div class="pull-right">
                        <div class="form-group">
                            <div class="col-md-12">           
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-ok-circle"></span> 
                                    @if	(isset($user))
                                    {{ Lang::get("admin/modal.edit") }}                                    
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

    </div>
</div>

</div>
@stop
@section('scripts')
@parent
<!--<script type="text/javascript">
    $(function () {
        $("#roles").select2()
    });
</script>-->
@stop
