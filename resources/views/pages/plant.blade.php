@extends('app')
@section('title') Home :: @parent @stop
@section('content')
@if(Auth::user())

@foreach($plants as $plant)
<div class="page-header">
    <h3>
        {{ $plant->Ort  }}  <small>- {{ $plant->Strasse  }} </small>
        <div class="pull-right">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url('home')}}">Back</a>
            </div>
        </div>
    </h3>
</div>
<div class="row">

    <table id="table" class="table table-striped table-hover ">

        <tbody>
            <tr>
                <td><strong>Inbetriebnahme:</strong></td>
                <td>{{ $plant->Inbetriebnahme  }} </td>
            </tr>
            <tr>
                <td><strong>Postleitzahl:</strong></td>
                <td>{{ $plant->PLZ  }} </td>
            </tr>
            <tr>
                <td><strong>Bundesland:</strong></td>
                <td>{{ $plant->bundesland  }} </td>
            </tr>
            <tr>
                <td><strong>Ort:</strong></td>
                <td>{{ $plant->Ort  }} </td>
            </tr>
            <tr> 
                <td><strong>Strasse:</strong></td>
                <td> {{ $plant->Strasse  }}</td>
            </tr>
            <tr>
                <td><strong>Anlagentyp:</strong></td>
                <td> {{ $plant->Anlagentyp  }}</td>
            </tr>
            <tr>
                <td><strong>kWh 2013:</strong></td>
                <td> {{ $plant->kWh_2013  }}</td>
            </tr>
            <tr>
                <td><strong>kWh Average:</strong></td>
                <td> {{ $plant->kWh_average  }}</td>
            </tr>
            <tr>
                <td><strong>DSO:</strong></td>
                <td> {{ $plant->DSO  }}</td>
            </tr>
            <tr>
                <td><strong>TSO:</strong></td>
                <td> {{ $plant->TSO  }}</td>
            </tr>
            <tr>
                <td><strong>Anlagenschluessel:</strong></td>
                <td>{{ $plant->Anlagenschluessel  }} </td>
            </tr>
            <tr>
                <td><strong>installierte Leistung KwP:</strong></td>
                <td> {{ $plant->leistung  }}</td>
            </tr>
            <tr>
                <td><strong>Energietraeger:</strong></td>
                <td> {{ $plant->energietraeger  }}</td>
            </tr>
            <tr>
                <td><strong>Netzbetreiber:</strong></td>
                <td> {{ $plant->netzbetreiber  }}</td>
            </tr>
            <tr>
                <td><strong>Anschrift:</strong></td>
                <td> {{ $plant->anschrift  }}</td>
            </tr>
            <tr>
                <td><strong>Anlagenhersteller:</strong></td>
                <td> {{ $plant->anlagenhersteller  }}</td>
            </tr>
            <tr>



        </tbody>
    </table>


</div>
@endforeach
@endif



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
