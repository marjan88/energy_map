@extends('app')

@section('title') Contact :: @parent @stop

@section('content')
@include('notifications')


<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        @include('users.partials.nav')
    </div>
    <div id="loading"  class="spinner">
        Loading...
    </div>
    <div class="col-sm-9 col-md-10 main">
        <div class="page-header">
            <h3>
                <i class="fa fa-phone"></i> Contact Form

            </h3>
        </div>

        <div class="col-lg-12">
            <form class="form-horizontal clearfix" action="{{route('contact.send')}}" method="POST" autocomplete="on">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="form-group {{{ $errors->has('subject') ? 'has-error' : '' }}}">
                    <label for="subject">Subject</label>
                    <input id="subject" class="form-control" type="text" name="subject" />
                    {!! $errors->first('subject', '<span class="help-block error">:message</span>')!!}
                </div>
                <div class="form-group {{{ $errors->has('text') ? 'has-error' : '' }}}">
                    <label for="text">Message</label>
                    <textarea style="width: 100%" id="text" name="text" rows="10"></textarea>
                    {!! $errors->first('text', '<span class="help-block error">:message</span>')!!}
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Send</button> 
                </div>
            </form>
        </div>
    </div>
</div>

@stop

{{-- Scripts --}}
@section('scripts')
@parent
@stop
