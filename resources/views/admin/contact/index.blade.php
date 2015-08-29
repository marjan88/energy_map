@extends('admin.layouts.default')
@section('main')
@include('notifications')
<div class="page-header">
    <h3>
        <i class="fa fa-phone"></i> {{ \Lang::get('admin/contact.contact-form')}}

    </h3>
</div>
<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" action="{{route('contact.create')}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">            

            <div class="form-group">               
                <div class="col-md-12">
                    <textarea name="text" id="summernote">@if($content){{$content->content}}@endif</textarea>
                </div>                
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>   


@stop
@section('scripts')
<script type="text/javascript" src="{{asset('assets/admin/js/summernote.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#summernote').summernote({
        height: 300, // set editor height

        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor

        focus: true, // set focus to editable area after initializing summernote
    });
});
</script>
@parent

@stop
