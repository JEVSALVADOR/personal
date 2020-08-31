<aside class="main-sidebar">

    <section class="sidebar">

            <div class="user-panel-pj">
                <div class="no-print image" style="text-align: center;">
                    <img src="{{asset('/img/fondo11.png')}}"  alt="User Image" style="margin-top: 0px;height: 100%;" />
                    <ul class="no-print sidebar-menu">
                    <li class="no-print stroke treeview info" style="font-family: Centaur;font-size: 15px;color: #696643;"><b>PODER JUDICIAL DEL PERÚ</b></li>
                    <li class="no-print stroke treeview" style="font-family: Centaur;font-size: 15px;color: #696643;"><b>Corte Superior De Justicia<br> De Ancash</b></li>
                    </ul>
                </div>
            </div>

            <ul class="no-print sidebar-menu">
            <li class="no-print active"><a href="#"><span></span></a></li>
            </ul>

        @if (! Auth::guest())
            <div class="user-panel" style="padding-bottom: 25px;white-space: normal;">
                <div class="pull-left image">
                      <img src="{{asset('/img/av1.png')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info" style="padding-left: 8px;padding-top: 1px;">

                    <p style="width: 145px!important;text-align: left;margin-bottom: 2px;font-size: 12px;word-break: break-all!important;line-height: 17px">{{ Auth::user()->personal->apellidosnombres }} ({{ Auth::user()->personal->dni }})</p>
                    
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif


        <ul class="sidebar-menu">
            <li class="header">Menú</li>
            <li class="active"><a href="{{ url('home') }}" id="#"><i class='fa fa-home'></i> <span>Inicio</span></a></li>

           
                @if(Auth::user()->tipo_user_id=="1" || Auth::user()->tipo_user_id=="3")
                    <!-- <li class="header">MENÚ ADMINISTRADOR</li> -->
                    <li class="treeview active">
                        <a href="#"><i class='fa fa-rss'></i> <span>Trabajo Remoto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="" id="sanexo4"><i class='fa fa-clipboard'></i> <span>Anexo 04</span></a></li>
                            <li><a href="" id="slistaanexo4"><i class='fa fa-list-ul'></i> <span>Lista Anexos Enviados</span></a></li>
                        </ul>
                    </li>
                @endif
            


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
