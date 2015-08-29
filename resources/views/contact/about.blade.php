@extends('app')

@section('title') Impressum :: @parent @stop

@section('content')
@include('notifications')


<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        @include('users.partials.nav')
    </div>
    
    <div class="col-sm-9 col-md-10 main">
        <div class="page-header">
            <h3>
                <i class="fa fa-info"></i> Impressum

            </h3>
        </div>

        <div class="col-lg-12">
            @if(isset($post)) 
            <?php echo  html_entity_decode(htmlentities($post->content)); ?>
            @endif
        </div>
    </div>
</div>

@stop

{{-- Scripts --}}
@section('scripts')
@parent
@stop
