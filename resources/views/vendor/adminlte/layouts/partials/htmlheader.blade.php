<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión de Personal - CORTE SUPERIOR DE JUSTICIA DE ANCASH</title>
    <link rel="icon" type="image/png" href="{{ asset('/img/fondo11.png') }}" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/plugins/sweetalert/lib/sweet-alert.css') }}" rel="stylesheet" />
    <link href="{{ asset('/plugins/alertify/themes/alertify.core.css') }}" rel="stylesheet" />
    <link href="{{ asset('/plugins/alertify/themes/alertify.default.css') }}" rel="stylesheet" />
    
    <link href="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
