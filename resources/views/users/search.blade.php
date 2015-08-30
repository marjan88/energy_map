@extends('app')

@section('title') Suche :: @parent @stop
@section('styles')
@parent
<link href="{{ asset('assets/admin/css/jquery-ui.min.css')}}"
      rel="stylesheet" type="text/css">

@endsection
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
                <i class="fa fa-bolt"></i> Anlagenregister
                <div class="pull-right">
                    <div class="pull-right">
                        @if(count($plants)>0) <small>You have <strong>{{count($plants)}}</strong> out of 25 plants</small> @endif
                    </div>
                </div>
            </h3>
        </div>
        @foreach($errors->all() as $error)
        {{ $error }}
        @endforeach
        <div class="alert alert-danger none" role="alert"></div>

        <div class="col-lg-4 col-centered">
            <form class="form-inline clearfix" id="search" autocomplete="off">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <input type="search" class="form-control" id="suche" name="term" placeholder="Suche Postleitzahl..">

                    <input type="hidden" name="id" id="id" />
                </div>
                <?php /* <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button> */ ?>
            </form>
        </div>
    </div>
</div>
<!-- MODAL -->
<div class="vSpace"></div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog big">
        <div class="modal-content">
            <form action="{{ url('user/anlagenregister/create') }}" method="post">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" id="arrayData" name="arrayId">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-bolt"></i> Anlagenregister</h4>
                </div>
                <div class="modal-body">
                    <!-- TABLE -->

                    
                    <table id="table" class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>Inbetriebnahme</th>
                                <th>Postleitzahl</th>
                                <th>Ort</th>
                                <th>Strasse</th>
                                <!--<th>Anlagenschluessel</th>-->
                                <th>Anlagentyp</th>
                                <th>installierte Leistung</th>
                                <th>Energietraeger</th>
                                <th>Netzbetreiber</th>
                                <th>checkbox</th>
                                <th>Action</th>


                            </tr>

                        </thead>
                        <tbody class="data"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modalDiv"></div>
@stop

{{-- Scripts --}}
@section('scripts')

@parent
{{--<script src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/dataTables.bootstrap.js')}}"></script>--}}
<script src="{{asset('assets/admin/js/bootstrap-dataTables-paging.js')}}"></script>
<script src="{{asset('assets/admin/js/datatables.fnReloadAjax.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.colorbox.js')}}"></script>
<script src="{{asset('assets/admin/js/modal.js')}}"></script>
<script src="{{  asset('assets/admin/js/jquery-ui.js') }}"></script>
<script type="text/javascript">
var base = "<?php echo url('/user/anlagenregister/') ?>";
</script>
<script src="{{  asset('assets/site/js/autocomplete.js') }}"></script>
<script src="{{  asset('assets/admin/js/chosen.jquery.js') }}"></script>
<script src="{{  asset('assets/admin/js/jquery.confirm.js') }}"></script>
<script type="text/javascript">
$(function () {
    console.log('as');
    $(".confirm").confirm({
        text: "Are you sure you want to delete thit item?",
        title: "Confirmation required",
        dialogClass: "modal-dialog test" // Bootstrap classes for large modal
    });
});
</script>
@stop
