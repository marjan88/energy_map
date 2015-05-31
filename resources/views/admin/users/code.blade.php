@extends('admin.layouts.default')
@section('main')
@include('notifications')
<div class="page-header">
    <h3>
        Register Code
        <div class="pull-right">
            <div class="pull-right">
                <a class="btn btn-sm btn-primary" href="{{ url('admin/users')}}"><span class="glyphicon glyphicon-backward"></span> Back</a>
            </div>
        </div>
    </h3>
</div>
<div class="row">
    <form name="codeForm" class="form-horizontal" style="margin-top: 20px" method="post"
          action="{{ URL::to('admin/code/new') }}"
          autocomplete="off">

        <!-- _token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        @if(isset($key))
        <!-- old code  -->
        <div class="col-md-8">
            <div class="form-group ">
                <label class="col-md-2 control-label" for="code">Register Code</label>
                <div class="col-md-10">
                    <input style="font-size: 24px"  class="form-control" tabindex="1" value="@if(isset($key)) {{$key->key }}@endif" type="text" >                   
                </div>
            </div>
            <hr/>
        </div>
        <div class="col-md-2">

            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mailModal">
                <span class="glyphicon glyphicon-envelope"></span> Send Mail</button>
        </div>
        @endif
        <!--code  -->
        <div class="col-md-8">
            <div class="form-group {{{ $errors->has('code') ? 'has-error' : '' }}}">
                <label class="col-md-2 control-label" for="code">New Register Code</label>
                <div class="col-md-10">
                    <input readonly="" class="form-control" tabindex="1" placeholder="Code" type="text" name="code" id="code">
                    {!!$errors->first('code', '<label class="control-label" for="code">:message</label>')!!}
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <input type="button" class="btn btn-sm btn-primary" value="Create New Random Code" onClick="randomString();">
        </div>
</div>     

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label class="col-md-2 control-label" for="code"></label>
            <div class="col-md-10" style="padding-left: 5px;">
                <button type="submit" class="btn btn-sm btn-success">
                    <span class="glyphicon glyphicon-ok-circle"></span>
                    {{Lang::get("admin/modal.save") }} 
                </button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- SEND MAIL MODAL -->   
<div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Mail Form</h4>
            </div>
            <form id="sendMailForm" class="form-horizontal" action="{{url('/admin/send-mail')}}" method="post" autocomplete="off">
                <!-- _token -->
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="modal-body">

                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">To</label>
                        <div class="col-sm-10">
                            <input data-validation="email" type="email" class="form-control" id="emailInput" name="email" placeholder="email">                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="subject" id="subject" value="Registration code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-sm-2 control-label">Registration Code</label>
                        <div class="col-sm-10">
                            <input readonly="" type="text" class="form-control" name="code" id="subject" value="@if(isset($key)) {{$key->key }}@endif">
                        </div>
                    </div>                    

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="sendMailBtn" type="submit" class="btn btn-primary">Send</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- END SEND MAIL MODAL -->
@stop
@section('scripts')
@parent
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.1/jquery.form-validator.min.js"></script>
<script language="javascript" type="text/javascript">
                function randomString() {
                    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
                    var string_length = 5;
                    var randomstring = '';
                    for (var i = 0; i < string_length; i++) {
                        var rnum = Math.floor(Math.random() * chars.length);
                        randomstring += chars.substring(rnum, rnum + 1);
                    }
                    document.codeForm.code.value = randomstring;
                }
                $('#mailModal').on('shown.bs.modal', function () {
                    $('#emailInput').focus();
                })
                $.validate();

</script>
@stop
