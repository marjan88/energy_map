@extends('layouts.sidenav')

{{-- Web site Title --}}
@section('title')
Administration :: @parent
@endsection

{{-- Styles --}}
@section('styles')
@parent

{{--<link href="{{asset('assets/admin/css/plugins/metisMenu/metisMenu.min.css')}}"--}}
{{--rel="stylesheet">--}}
{{--<link href="{{asset('assets/admin/css/sb-admin-2.css')}}"--}}
{{--rel="stylesheet">--}}
{{--<link href="{{asset('assets/admin/css/jquery.dataTables.css')}}"--}}
{{--rel="stylesheet">--}}
{{--<link href="{{asset('assets/admin/css/dataTables.bootstrap.css')}}"--}}
{{--rel="stylesheet">--}}
{{--<link href="{{asset('assets/admin/css/colorbox.css')}}" rel="stylesheet">--}}

<link href="{{ asset('assets/admin/css/jquery-ui.min.css')}}"
      rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://css-spinners.com/css/spinner/spinner.css" type="text/css">
@endsection


{{-- Sidebar --}}
@section('sidebar')
@include('admin.partials.nav')
@endsection

{{-- Scripts --}}
@section('scripts')
@parent

{{-- Not yet a part of Elixir workflow --}}
{{--<script src="{{asset('assets/admin/js/jquery-migrate-1.2.1.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/jquery-ui.1.11.2.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/plugins/metisMenu/metisMenu.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/sb-admin-2.js')}}"></script>--}}

{{--<script src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/dataTables.bootstrap.js')}}"></script>--}}
<script src="{{asset('assets/admin/js/bootstrap-dataTables-paging.js')}}"></script>
<script src="{{asset('assets/admin/js/datatables.fnReloadAjax.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.colorbox.js')}}"></script>
<script src="{{asset('assets/admin/js/modal.js')}}"></script>
<script src="{{  asset('assets/admin/js/jquery-ui.js') }}"></script>
<script type="text/javascript">
var base = "<?php echo url('/admin/anlagenregister/') ?>";
</script>
<script src="{{  asset('assets/admin/js/autocomplete.js') }}"></script>
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

<script type="text/javascript">
var config = {
  '.chosen-select': {},
  '.chosen-select-deselect': {allow_single_deselect: true},
  '.chosen-select-no-single': {disable_search_threshold: 10},
  '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
  '.chosen-select-width': {width: "95%"}
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}
</script>

{{-- Default admin scripts--}}
<script type="text/javascript">
//    {
//        {
//            --from sb - admin - 2 --
//        }
//    }
    $(function () {
        $('#menu').metisMenu();
    });
</script>

@endsection
