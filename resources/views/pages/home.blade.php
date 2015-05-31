@extends('app')
@section('title') Home :: @parent @stop
@section('content')
<div class="row">
    <div id="loading"  class="spinner">
        Loading...
    </div>
    <div class="page-header">
        <h2><i class="fa fa-bolt"></i>
            Energien Plant</h2>
    </div>
    @if(Auth::user())
    <table id="plants" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Inbetriebnahme</th>
                <th>Postleitzahl</th>                
                <th>Ort</th>
                <th>Strasse</th>
                <th>Anlagenschluessel</th>
                <th>Anlagentyp</th>                
                <th>installierte Leistung KwP</th>
                <th>Energietraeger</th>
                <th>Netzbetreiber</th>                
                <th>Action</th>

            </tr>
        </thead>
        <tbody class="data"></tbody>
    </table>
    @endif

</div>




@endsection

@section('scripts')
@parent
<script type="text/javascript">
    var base = "<?php echo url('/anlagenregister/') ?>";
</script>
{{--<script src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/dataTables.bootstrap.js')}}"></script>--}}
<script src="{{asset('assets/admin/js/bootstrap-dataTables-paging.js')}}"></script>
<script src="{{asset('assets/admin/js/datatables.fnReloadAjax.js')}}"></script>
<script src="{{asset('assets/site/js/plants.js')}}"></script>

@endsection
@stop
