@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body class="hold-transition login-page">
    <div id="app">
        <div class="login-box2">
            
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!</strong> Hubo algunos problemas con el Inicio de Sesión.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="login-box-body" style="border-radius: 5px;">

        <div class="" style="text-align: center;">
            <img style="text-align: center;width: 97%" src="{{asset('/img/banner2.png')}}" />
            <img style="text-align: center;width: 90%;padding-top: 8px;" src="{{asset('/img/banner33.png')}}" />
        </div>
        <hr style="margin-top: 15px;margin-bottom: 15px;">
    

        <form action="{{ url('/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group has-feedback">
              <label for="inputNombres">DNI</label>
              <input type="text" class="form-control" placeholder="DNI" name="name" maxlength="8" required/>
              <span class="fa fa-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="inputNombres">Contraseña</label>
                <input type="password" class="form-control" placeholder="Contraseña" name="password" required/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
                </div>
                <div class="col-xs-5" style="padding-left: 0px;">
                    <a href="{{ url('/') }}" class="text-center btn btn-danger btn-block btn-flat">Volver</a>
                </div><!-- /.col -->
            </div>
        </form>
        <br>
        
<!--         <div class="col-xs-12" style="padding-left: 0px;">
            <span class="label label-default" style="font-size: 13px;background-color: #dddddd">
                <a href="img/Manual_Plataforma_Virtual_MesadePartes_CSJAN.pdf" target="__blank">Manual de Usuario</a>
            </span>
        </div> -->
        <div class="col-xs-12" style="padding-top: 7px;padding-left: 0px;">
            <span class="label label-default" style="font-size: 13px;background-color: #dddddd">
                <a href="{{ url('/password/reset') }}">Olvide mi Contraseña</a>
            </span>
        </div>
        
       <br>
       <br>

    </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
