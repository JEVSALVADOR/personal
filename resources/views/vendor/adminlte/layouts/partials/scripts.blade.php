<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/mostrarMenu.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/axios.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/alertify/lib/alertify.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
