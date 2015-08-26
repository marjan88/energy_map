@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ Lang::get("admin/users.users") }}} :: @parent
@stop

{{-- Content --}}
@section('main')
@include('notifications')
    <div class="page-header">
        <h3>
            <i class="fa fa-users"></i> 
            {{{ Lang::get("admin/users.users") }}}
            <div class="pull-right">
            <div class="pull-right">
                <a class="btn btn-sm btn-default" href="{{route('user.create')}}">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    Neue Kunden
                </a>
            </div>
        </div>
            
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{{ Lang::get("admin/users.name") }}}</th>
            <th>{{{ Lang::get("admin/users.last_name") }}}</th>
            <th>{{{ Lang::get("admin/users.city") }}}</th>
            <th>{{{ Lang::get("admin/users.email") }}}</th>
            <th>{{{ Lang::get("admin/users.active_user") }}}</th>
            <th>{{{ Lang::get("admin/users.last_login") }}}</th>       
            <th>{{{ Lang::get("admin/admin.action") }}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
    <script type="text/javascript">
        var oTable;
        $(document).ready(function () {
            oTable = $('#table').dataTable({
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('admin/users/data/') }}",
                "fnDrawCallback": function (oSettings) {
                    $(".iframe").colorbox({
                        iframe: true,
                        width: "80%",
                        height: "80%",
                        onClosed: function () {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>
@stop
