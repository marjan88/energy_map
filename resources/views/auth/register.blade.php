@extends('app')

{{-- Web site Title --}}
@section('title') {{{ Lang::get('site/user.register') }}} :: @parent @stop

{{-- Content --}}
@section('content')
@include('partials.notifications')
<div class="row">
    <div class="page-header">
        <h2>{{{ Lang::get('site/user.register') }}}</h2>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        {{--<div class="col-md-8 col-md-offset-2">--}}
        {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading">Register</div>--}}
        {{--<div class="panel-body">--}}

        @include('errors.list')

        <form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/auth/register') !!}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- FIST NAME -->
            <div class="form-group">
                <label class="col-md-4 control-label">{{{ Lang::get('site/user.first_name')}}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>

            </div>                           

            <!-- LAST NAME -->
            <div class="form-group">
                <label class="col-md-4 control-label">{{{ Lang::get('site/user.last_name')}}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="last_name"
                           value="{{ old('last_name') }}">
                </div>
            </div>
            <!-- STREET -->
            <div class="form-group">
                <label class="col-md-4 control-label">{{{ Lang::get('site/user.street')}}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="street"
                           value="{{ old('street') }}">
                </div>
            </div>
            <!-- CITY -->
            <div class="form-group">
                <label class="col-md-4 control-label">{{{ Lang::get('site/user.city')}}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="city"
                           value="{{ old('city') }}">
                </div>
            </div>

            <!-- PHONE  -->
            <div class="form-group">
                <label class="col-md-4 control-label">{{{ Lang::get('site/user.phone')}}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="phone"
                           value="{{ old('phone') }}">
                </div>
            </div>
            <!-- EMAIL  -->
            <div class="form-group">
                <label class="col-md-4 control-label">{{{ Lang::get('site/user.e_mail') }}}</label>

                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <!-- PASSWORD  -->
            <div class="form-group">
                <label class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <!-- CONFIRM PASSWORD  -->
            <div class="form-group">
                <label class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
            </div>
            <!-- CODE  -->
            <div class="form-group ">
                <label class="col-md-4 control-label">{{ Lang::get("site/user.registration_key") }}</label>
                <div class="col-md-6">
                    @for($i=0; $i<5; $i++)
                    <input size="1" maxlength="1" type="text" class="form-control key" name="code[{{$i}}]">
                    @endfor
                    <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="bottom" title='{{Lang::get("site/site.tooltip")}}'><i>info</i></button>
                </div>

            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
@endsection
@section('scripts')
<script>
    jQuery('.key').bind({keyup: function () {
            $(this).next().focus()
        }});
</script>
@stop