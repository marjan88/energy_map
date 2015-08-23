@extends('admin.layouts.default')
@section('main')
@include('notifications')
<div class="page-header">
    <h3>
        <i class="fa fa-phone"></i> {{ \Lang::get('admin/contact.contact-form')}}
        
    </h3>
</div>
<div class="row">
    
</div>   


@stop
@section('scripts')
@parent

@stop
