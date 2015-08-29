@extends('app')
@section('title') Home :: @parent @stop

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
            <h2><i class="fa fa-bolt"></i>
                Energien Plant</h2>
        </div>
        @if(count($plants) > 0)
        <table id="plants" class="table table-striped table-hover">
            <thead>
                <tr>
                    <!--<th>Inbetriebnahme</th>-->
                    <th>Postleitzahl</th>                
                    <th>Ort</th>
                    <th>Strasse</th>
                    <!--<th>Anlagenschluessel</th>-->
                    <th>Anlagentyp</th>                
                    <th>installierte Leistung KwP</th>
                    <th>Energietraeger</th>
                    <th>Netzbetreiber</th>                
                    <th>Action</th>

                </tr>
            </thead>
            <tbody class="data"></tbody>
        </table>
        @else
        You have no plants, please, go and choose plants.
        @endif

    </div>
</div>



@endsection

@section('scripts')
@parent
<script type="text/javascript">
    var base = "<?php echo url('/user/anlagenregister/') ?>";
</script>
{{--<script src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/dataTables.bootstrap.js')}}"></script>--}}
<script src="{{asset('assets/admin/js/bootstrap-dataTables-paging.js')}}"></script>
<script src="{{asset('assets/admin/js/datatables.fnReloadAjax.js')}}"></script>
<script src="{{asset('assets/site/js/plants.js')}}"></script>

@endsection
@stop
