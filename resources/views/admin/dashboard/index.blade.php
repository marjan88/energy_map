@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}
@section('main')

<div class="page-header">
    <h3>
        {{$title}}
    </h3>
</div>

<div class="row">

    <div class="col-lg-9 col-md-6">
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-users"></i> Recent Users</h3>
            </div>
            <div class="panel-body">

                <ul class="list-group">
                    <?php $i = 1; ?>
                    @foreach($lastUsers as $lastUser)
                    <li class="list-group-item">{{$i . '. ' .$lastUser->name . ' ' . $lastUser->last_name}}</li>
                        <?php $i++; ?>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>
@endsection
{{-- Scripts --}}
@section('scripts')
@parent
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="{{asset('assets/admin/js/highchart.js')}}"></script>
@stop
