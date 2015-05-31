@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') Anlagenregister :: @parent @stop

{{-- Content --}}
@section('main')
@include('notifications')

<div class="page-header">
    <h3>
        Anlagenregister
        <div class="pull-right">
            <div class="pull-right"> 
            </div>
        </div>
    </h3>
</div>
<div class="row">
    @foreach($errors->all() as $error)
    {{ $error }}
    @endforeach
    <div class="alert alert-danger none" role="alert"></div>

    <div class="col-lg-4 col-centered">
        <form class="form-inline clearfix" id="search" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="search" class="form-control" id="suche" name="term" placeholder="Postleitzahl..">

                <input type="hidden" name="id" id="id" />
            </div>
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<!-- MODAL -->
<div class="vSpace"></div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog big">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-bolt"></i> Anlagenregister</h4>
            </div>
            <div class="modal-body">
                <!-- TABLE -->
                <form action="{{ url('admin/anlagenregister/create') }}" method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <table id="table" class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>Inbetriebnahme</th>
                                <th>Postleitzahl</th>
                                <th>Ort</th>
                                <th>Strasse</th>
                                <th>Anlagenschluessel</th>
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
                <button type="button" class="btn btn-default refresh" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modalDiv"></div>
@stop

{{-- Scripts --}}
@section('scripts')

@parent

@stop
