@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')

<style type="text/css">
    .swal-text {
      background-color: #FEFAE3;
      padding: 17px;
      border: 1px solid #F0E1A1;
      display: block;
      margin: 22px;
      text-align: center;
      color: #61534e;
    }
</style>

<body id="headerwrap">

    <div id="app"></div>
    <div id="datosCrud">

        <div class="login-box">
            
        <div class="login-box-body descarga" style="border-radius: 5px;zoom: 100%">

        <div class="col-sm-12" style="text-align: center;padding-left: 0px;padding-right: 0px;padding-top: 10px;">
    
            <div class="col-sm-6" style="text-align: center;">
                <img style="text-align: center;width: 70%" class="pull-left" src="{{asset('/img/banner2.png')}}"/>
            </div>
            <div class="col-sm-6" style="text-align: center;">
                    <img style="text-align: center;width: 70%" src="{{asset('/img/banner33.png')}}"/>
            </div>

            <div class="col-sm-12" style="padding-left: 20px;padding-right: 20px;padding-top: 15px;background-color: #fff!important;">
                <div class="col-sm-12" style="text-align: center;background-color: #125997;border-radius: 5px;padding-top: 5px;padding-bottom: 5px;">
                        <div class="widget" style="color: #fff;height: 100%">
                            <h4>TRABAJO REMOTO EN LOS ÓRGANOS JURISDICCIONALES Y ADMINISTRATIVOS DEL PODER JUDICIAL</h4>
                            <!-- <h4>Declaración Jurada</h4> -->
                        </div>
                </div>
            </div>
            <div class="col-sm-12">
                <hr style="margin-top: 15px;margin-bottom: 10px;">
            </div>
        </div>
        

        <form action="/" method="post" id="formficha" style="padding-left: 20px;padding-right: 20px;" v-on:submit.prevent="createArea" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="row">
                
                <div class="col-sm-12">
                    <div class="col-sm-5" style="padding-left: 0px;">
                        <div class="form-group has-feedback">
                          <label for="inputNombres" style="color: #000;font-size: 16px;font-weight: bold;">Ingrese su DNI</label>
                          <input type="text" class="form-control" style="font-size: 17px;" placeholder="DNI" id="dni" name="dni" onkeypress="return soloNumeros(event);" v-model="fillArea.dni" maxlength="8" required/> 
                        </div>
                    </div>
                   
                    <div class="col-sm-4">
                        <div class="form-group has-feedback">
                          <label for="inputNombres" style="color: #000;font-size: 16px;font-weight: bold;">&nbsp;</label>
                          <a href="#" id="consultar" class="text-center btn btn-primary btn-block btn-flat" v-on:click.prevent="consultarDatos()">Validar Datos</a>
                        </div>
                    </div>

                    <div class="col-sm-3" style="padding-right: 0px;">
                        <div class="form-group has-feedback">
                          <label for="inputNombres" style="color: #000;font-size: 16px;font-weight: bold;">&nbsp;</label>
                           <a href="{{ url('/') }}" id="cancelar" class="text-center btn btn-warning btn-block btn-flat">Volver</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-12" style="padding: 0px;">
                <hr style="margin-top: 0px;margin-bottom: 15px;">                
            </div>
             
            <div class="col-sm-12 box box-danger" id="divdatospersonales" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f4f4f4;">
                <div class="box-header with-border">
                  <h4 style="font-size: 15px;font-weight: bold;" class="box-title">Datos del Personal</h4>
                </div>
                <div class="box-body" style="padding-top: 0px;">

                    <div class="form-group has-feedback col-sm-4" style="padding-left: 0px;">
                      <label for="inputNombres">Apellidos y Nombres</label>
                      <input type="text" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Apellidos y Nombres" id="apellidosnombres" name="apellidosnombres"  v-model="fillArea.apellidosnombres" disabled />
                    </div>
                    <div class="form-group has-feedback col-sm-4">
                      <label for="inputDependencia">Dependencia</label>
                      <input type="text" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Dependencia" id="dependencia" name="dependencia"  v-model="fillArea.dependencia" disabled />
                    </div>
                    <div class="form-group has-feedback col-sm-4" style="padding-right: 0px;">
                      <label for="inputCargo">Cargo</label>
                      <input type="text" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Cargo" id="cargo" name="cargo"  v-model="fillArea.cargo" disabled />
                    </div>
                </div>
            </div>

            <div class="col-sm-12 box box-danger" id="divAnexosGenerados" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f4f4f4;">
                <div class="box-header with-border">
                  <h4 style="font-size: 15px;font-weight: bold;" class="box-title">Anexos 04 Generados por: @{{ fillArea.apellidosnombres }}</h4>
                </div>
                <div class="box-body">

                   <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>observaciones</th>
                                <th style="text-align: center;">Estado</th>
                                <th>Archivo</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(detalles, index) in detalle">
                                <td width="10px" style="font-family: Arial; font-size: 12px;">@{{ index+pagination.from }}</td>
                                <td style="font-family: Arial; font-size: 12px;">@{{ detalles.fec_ini }}</td>
                                <td style="font-family: Arial; font-size: 12px;">@{{ detalles.fec_fin }}</td>
                                <td style="font-family: Arial; font-size: 12px;">@{{ detalles.observaciones }}</td>
                                
                                <td v-if="detalles.estado==0" style="text-align: center;font-family: Arial; font-size: 12px;vertical-align: middle;">
                                    <span class="badge bg-yellow">Borrador</span>
                                </td>
                                <td v-if="detalles.estado==1" style="text-align: center;font-family: Arial; font-size: 12px;vertical-align: middle;">
                                    <span class="badge bg-light-blue">Enviado a Jefe Inmediato</span>
                                </td>
                                <td v-if="detalles.estado==2" style="text-align: center;font-family: Arial; font-size: 12px;vertical-align: middle;">
                                    <span class="badge bg-red">Observado</span>
                                </td>
                                <td v-if="detalles.estado==3" style="text-align: center;font-family: Arial; font-size: 12px;vertical-align: middle;">
                                    <span class="badge bg-green">Aprobado</span>
                                </td>

                                <td style="font-family: Arial; font-size: 12px;">@{{ detalles.archivogenerado }}</td>
                                <td width="10px" style="text-align: center;">
                                    <a href="#" style="font-size: 12px;" data-placement="bottom" data-toggle="tooltip" title="Editar Anexo" class="btn btn-warning btn-hover-info btn-sm fa fa-pencil" v-on:click.prevent="cargarDetalleGeneral(detalles)"></a>
                                </td>
                            </tr>
                    
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="col-sm-12 box" id="divbotones" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f4f4f4;">
                <div class="box-body">

                   <!--  <div class="progress" id="divProgress" style="margin-bottom: 10px;margin-top: 0px;">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" id="pro" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                    </div> -->

                    <div class="col-sm-12" style="padding-right: 0px;padding-left: 0px;padding-bottom: 0px;">
                        
                        <div class="col-sm-1"></div>
                        <div class="form-group has-feedback col-sm-2" style="padding-right: 15px;padding-left: 0px;">
                          <label for="inputDependencia">Fecha Incio</label>
                          <input type="date" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" id="fec_ini1" name="fec_ini1"  v-model="fillDetalle.fec_ini1" />
                        </div>
                        <div class="form-group has-feedback col-sm-2" style="padding-right: 10px;padding-left: 0px;">
                          <label for="inputDependencia">Fecha Fin</label>
                          <input type="date" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" id="fec_fin1" name="fec_fin1"  v-model="fillDetalle.fec_fin1" />
                        </div>

                        <div class="col-sm-3" style="padding-top: 24px;">
                            <a href="#" id="btnGenerar" class="text-center btn btn-success btn-block btn-flat" v-on:click.prevent="generarAnexo04(fillArea.id)" disabled>Generar Nuevo Anexo</a>
                        </div>
                        <div class="col-sm-3" style="padding-top: 24px;">
                            <a href="#" id="btnCancelar" class="text-center btn btn-danger btn-block btn-flat" v-on:click.prevent="cancelar()" disabled>Cancelar</a>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                
            </div>

                <div class="modal fade" id="mensajefinal" tabindex="-1" role="dialog" aria-labelledby="modalDetalleobsLabel" aria-hidden="true">
                    <div class="modal-dialogxl">
                        <div class="modal-content">
                          <div class="modal-header panel panel-success" style="background-color: #337ab7;border-color: #2e6da4;margin-bottom: 0px;padding-top: 10px;padding-bottom: 10px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" style="font-size: 14px;font-weight: bold;color: white;">METAS INDIVIDUALES A REALIZAR DURANTE EL TRABAJO REMOTO</h4>
                          </div>
                          <div class="modal-body box-body" style="padding-left: 20px;padding-right: 20px;">

                            <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                                <div class="col-sm-12 box box-primary" id="divdetallegeneral" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f8f8f8;margin-bottom: 15px;">
                                    <div class="box-body">
                                        <div class="form-group has-feedback col-sm-2" style="padding-right: 15px;padding-left: 0px;">
                                          <label for="inputDependencia">Fecha Incio</label>
                                          <input type="date" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" id="fec_ini" name="fec_ini"  v-model="fillDetalle.fec_ini" />
                                        </div>
                                        <div class="form-group has-feedback col-sm-2" style="padding-right: 10px;padding-left: 0px;">
                                          <label for="inputDependencia">Fecha Fin</label>
                                          <input type="date" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" id="fec_fin" name="fec_fin"  v-model="fillDetalle.fec_fin" />
                                        </div>
                                        <div class="form-group has-feedback col-sm-8" style="padding-right: 0px;padding-left: 5px;">
                                          <label for="inputCargo">Observaciones</label>
                                          <input type="text" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Observaciones" id="observaciones" name="observaciones"  v-model="fillDetalle.observaciones" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                                <div class="col-sm-12 box box-warning" id="divactividades" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f8f8f8;margin-bottom: 15px;">
                                    <div class="box-header with-border" style="padding-bottom: 0px;">
                                      <h4 style="font-size: 15px;font-weight: bold;" class="box-title">Actividades</h4>
                                    </div>

                                    <!-- <form v-on:submit.prevent="updateActividad">                                     -->
                                        <div class="box-body">
                                            <div class="form-group has-feedback col-sm-5" style="padding-left: 0px;padding-right: 5px;margin-bottom: 8px;">
                                              <label for="inputActi" style="font-size: 12px;"><b>Nombre Actividad</b></label>
                                              <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 10px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Actividad" id="actividad" name="actividad"  v-model="fillDetalle.actividad" />
                                            </div>
                                            <div class="form-group has-feedback col-sm-2" style="padding-left: 10px;padding-right: 15px;margin-bottom: 8px;">
                                              <label for="inputDia" style="font-size: 12px;"><b>Día</b></label>
                                              <input type="date" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" id="dia" name="dia"  v-model="fillDetalle.dia" />
                                            </div>
                                            <div class="form-group has-feedback col-sm-1" style="padding-left: 0px;padding-right: 5px;margin-bottom: 8px;">
                                              <label for="inputNombres" style="font-size: 12px;"><b>Horas</b></label>
                                              <select  style="width: 100%;font-family: Arial;font-size: 13px;font-weight: bold;padding-right: 5px;padding-left: 5px;" aria-hidden="true" id="horas" name="horas" v-model="fillDetalle.horas" class="form-control" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                              </select>
                                            </div>
                                            <div class="form-group has-feedback col-sm-4" style="padding-left: 10px;padding-right: 0px;margin-bottom: 8px;">
                                              <label for="inputObjetivo" style="font-size: 12px;"><b>Objetivo</b></label>
                                              <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 10px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Objetivo" id="objetivo" name="objetivo"  v-model="fillDetalle.objetivo" />
                                            </div>
                                            <div class="form-group has-feedback col-sm-4" style="padding-left: 0px;margin-bottom: 8px;">
                                              <label for="inputIndi" style="font-size: 12px;font-weight: bold;">Indicador</label>
                                              <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 10px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Indicador" id="indicador" name="indicador"  v-model="fillDetalle.indicador" />
                                            </div>

                                            <div class="form-group has-feedback col-sm-4" style="padding-left: 0px;padding-right: 5px;margin-bottom: 8px;">
                                              <label for="inputMeta" style="font-size: 12px;font-weight: bold;">Meta</label>
                                              <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 10px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Meta" id="meta" name="meta"  v-model="fillDetalle.meta" />
                                            </div>
                                            <div class="form-group has-feedback col-sm-4" style="padding-left: 10px;padding-right: 0px;margin-bottom: 8px;">
                                              <label for="inputEvidencia" style="font-size: 12px;font-weight: bold;">Evidencia</label>
                                              <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 10px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Evidencia" id="evidencia" name="evidencia"  v-model="fillDetalle.evidencia" />
                                            </div>
                                            <div class="form-group has-feedback col-sm-4" style="padding-left: 0px;margin-bottom: 8px;">
                                              <label for="inputCargo" style="font-size: 12px;font-weight: bold;">Logros Intermedios</label>
                                              <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 10px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Logros Intermedios" id="logrosintermedios" name="logrosintermedios"  v-model="fillDetalle.logrosintermedios" />
                                            </div>

                                            <div class="form-group has-feedback col-sm-2" style="padding-left: 0px;padding-right: 5px;margin-bottom: 8px;">
                                              <label for="inputNivellog" style="font-size: 12px;font-weight: bold;">Nivel de Logro Esperado</label>
                                              <select  style="width: 100%;font-family: Arial;font-size: 12px;font-weight: bold;" aria-hidden="true" id="nivelogro" name="nivelogro" v-model="fillDetalle.nivelogro" class="form-control" required>
                                                    <option value="A">A (100%)</option>
                                                    <option value="B">B (95%)</option>
                                                    <option value="C">C (70%)</option>
                                                    <option value="D">D (40%)</option>
                                                    <option value="E">E (10%)</option>
                                              </select>
                                            </div>
                                            <div class="form-group has-feedback col-sm-2" style="padding-left: 5px;padding-right: 5px;margin-bottom: 8px;">
                                              <label for="inputLogroalcan" style="font-size: 12px;font-weight: bold;">Nivel de Logro Alcanzado</label>
                                              <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 10px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Nivel de Logro Alcanzado" id="nivelogroalcanzado" name="nivelogroalcanzado"  v-model="fillDetalle.nivelogroalcanzado" />
                                            </div>
                                            <div class="form-group has-feedback col-sm-2" style="padding-right: 0px;padding-left: 10px;margin-bottom: 8px;">
                                              <label for="inputPuntua" style="font-size: 12px;font-weight: bold;">Puntuación</label>
                                              <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 10px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Puntuación" id="puntuacion" name="puntuacion"  v-model="fillDetalle.puntuacion" />
                                            </div>

                                            <div class="form-group has-feedback col-sm-2" style="padding-right: 0px;margin-bottom: 0px;vertical-align: middle;padding-top: 25px;">
                                                <a style="" href="#" class="btn btn-danger btn-hover-info fa fa-remove pull-right" v-on:click.prevent="limpiarActividad()"></a>
                                                <input style="margin-left: 10px;" type="submit" name="addSeg" id="anadirActividad" class="btn btn-warning pull-right" value="Añadir" v-on:click.prevent="agregarActividad(fillDetalle.id)">
                                            </div>

                                        </div>
                                    <!-- </form> -->
                                    <div class="col-sm-12 box box-warning" style="padding-left: 0px;padding-right: 0px;">
                                        <div class="box-body">
                                            <table class="table table-striped" id="tbdesca">
                                              <thead>
                                                      <tr>
                                                          <th>#</th>
                                                          <th style="width: 20%;font-size: 11px;">Actividad</th>
                                                          <th style="text-align: center;font-size: 11px;">Objetivo</th>
                                                          <th style="text-align: center;font-size: 11px;">Indicador</th>
                                                          <th style="text-align: center;font-size: 11px;">Meta</th>
                                                          <th style="text-align: center;font-size: 11px;">Evidencia</th>
                                                          <th style="text-align: center;font-size: 11px;">Logros intermedios</th>
                                                          <th style="text-align: center;font-size: 11px;">Niv. de logro esperado</th>
                                                          <th style="text-align: center;font-size: 11px;">Valor Asignado</th>
                                                          <th style="text-align: center;font-size: 11px;">Peso Asignado</th>
                                                          <th style="text-align: center;font-size: 11px;">Niv. de logro Alcanzado</th>
                                                          <th style="text-align: center;font-size: 11px;">Puntuación</th>
                                                          <th style="text-align: center;font-size: 11px;">Control</th>
                                                      </tr>
                                                  </thead>
                                              <tbody>

                                                <tr v-for="(actividads, index) in actividades">
                                                          <td width="10px" style="font-family: Arial; font-size: 11px;">@{{ index+1 }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;">@{{ actividads.actividad }} <br><b>Día: @{{ actividads.dia }}</b> Horas: <b>@{{ actividads.horas }}</b></td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.objetivo }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.indicador }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.meta }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.evidencia }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.logrosintermedios }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.nivelogro }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.valorasignado }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.pesoasignado }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.nivelogroalcanzado }}</td>
                                                          <td style="font-family: Arial; font-size: 11px;text-align: center;">@{{ actividads.puntuacion }}</td>
                                                          <td width="100px" style="text-align: center;font-size: 10px;">
                                                            <a style="font-size: 11px;" href="#" class="btn btn-warning btn-hover-info btn-sm fa fa-pencil" v-on:click.prevent="modificarActividad(actividads)"></a>
                                                            <a style="font-size: 11px;" href="#" class="btn btn-danger btn-hover-info btn-sm fa fa-trash" v-on:click.prevent="deleteActividad(actividads)"></a>
                                                          </td>
                                                          
                                                </tr>
                                            
                                              </tbody>
                                          </table>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            
                            <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                                <div class="col-sm-12 box box-danger" id="divcompromiso" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f8f8f8;margin-bottom: 15px;">
                                    <div class="box-header with-border" style="padding-bottom: 0px;">
                                      <h4 style="font-size: 15px;font-weight: bold;" class="box-title">Compromiso</h4>
                                    </div>

                                    <div class="box-body">
                                        <div class="form-group has-feedback col-sm-4" style="padding-left: 0px;padding-right: 5px;">
                                          <label for="inputNombres">Compromiso</label>
                                          <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Compromiso" id="compromiso" name="compromiso"  v-model="fillDetalle.compromiso" />
                                        </div>
                                        <div class="form-group has-feedback col-sm-4" style="padding-left: 5px;padding-right: 0px;">
                                          <label for="inputDependencia">Descripción</label>
                                          <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Descripción" id="descripcion" name="descripcion"  v-model="fillDetalle.descripcion" />
                                        </div>
                                        <div class="form-group has-feedback col-sm-4" style="padding-right: 0px;">
                                          <label for="inputCargo">Nivel de Desarrollo Exigido(MPP)</label>
                                          <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Nivel de Desarrollo Exigido(MPP)" id="niveldesarrolloexig" name="niveldesarrolloexig"  v-model="fillDetalle.niveldesarrolloexig" />
                                        </div>

                                        <div class="form-group has-feedback col-sm-6" style="padding-left: 0px;padding-right: 5px;">
                                          <label for="inputNombres">Comportamiento asociados a cada nivel</label>
                                          <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Comportamiento asociados a cada nivel" id="compromiso" name="compromiso"  v-model="fillDetalle.compromiso" />
                                        </div>
                                        <div class="form-group has-feedback col-sm-2" style="padding-left: 5px;padding-right: 0px;">
                                          <label for="inputDependencia">Nivel de Evidenciado</label>
                                          <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Nivel de Evidenciado" id="descripcion" name="descripcion"  v-model="fillDetalle.descripcion" />
                                        </div>
                                        <div class="form-group has-feedback col-sm-2" style="padding-right: 0px;">
                                          <label for="inputCargo">Brecha</label>
                                          <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Brecha" id="niveldesarrolloexig" name="niveldesarrolloexig"  v-model="fillDetalle.niveldesarrolloexig" />
                                        </div>
                                         <div class="form-group has-feedback col-sm-2" style="padding-right: 0px;margin-bottom: 0px;vertical-align: middle;padding-top: 25px;">
                                            <a style="" href="#" class="btn btn-danger btn-hover-info fa fa-remove pull-right" v-on:click.prevent="limpiarSegBienSocial()"></a>
                                            <input style="margin-left: 10px;" type="submit" name="addSeg" id="anadirCompromiso" class="btn btn-warning pull-right" value="Añadir">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 box box-danger" style="padding-left: 0px;padding-right: 0px;">
                                        <div class="box-body">
                                            <table class="table table-striped" id="tbdesca">
                                              <thead>
                                                      <tr>
                                                          <th>#</th>
                                                          <th>Compromiso</th>
                                                          <th>Descripción</th>
                                                          <th>Nivel de Desarrollo Exigido(MPP)</th>
                                                          <th>Comportamiento asociados a cada nivel</th>
                                                          <th>Nivel de Evidenciado</th>
                                                          <th>Brecha</th>
                                                          <th style="text-align: center;">Control</th>
                                                      </tr>
                                                  </thead>
                                              <tbody>

                                                <tr v-for="(compromiso, index) in compromisos">
                                                          <td width="10px" style="font-family: Arial; font-size: 12px;">@{{ index+pagination.from }}</td>
                                                          <td style="font-family: Arial; font-size: 12px;">@{{ compromiso.compromiso }}</td>
                                                          <td style="font-family: Arial; font-size: 12px;">@{{ compromiso.descripcion }}</td>
                                                          <td style="font-family: Arial; font-size: 12px;">@{{ compromiso.niveldesarrolloexig }}</td>
                                                          <td style="font-family: Arial; font-size: 12px;">@{{ compromiso.comportamientoasocnivel }}</td>
                                                          <td style="font-family: Arial; font-size: 12px;">@{{ compromiso.nivelevidenciado }}</td>
                                                          <td style="font-family: Arial; font-size: 12px;">@{{ compromiso.brecha }}</td>
                                                          <td width="10px" style="text-align: center;font-size: 10px;">
                                                            <a style="font-size: 11px;" href="#" class="btn btn-danger btn-hover-info btn-sm fa fa-trash" v-on:click.prevent="deleteDescanso(compromiso)"></a>
                                                          </td>
                                                          
                                                </tr>
                                            
                                              </tbody>
                                          </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <span v-for="error in errors" class="text-danger">@{{ error }}</span>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" style="margin-left: 10px;margin-right: 5px;">Cerrar</button>
                            <input type="submit" name="" style="margin-right: 10px;margin-left: 10px;" class="btn btn-warning" value="Guardar Borrador">
                            <input type="submit" name="" style="margin-right: 10px;margin-left: 10px;" class="btn btn-primary" value="Enviar a Jefe Inmediato">
                          </div>
                        </div>
            <!-- /.modal-content -->
                    </div>
                </div>

        </form>
       
    </div>

    </div>
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

    <script>
                                         
    app = new Vue({

            el: '#datosCrud',
            created: function(){
                this.getArea();
            },
            data: {
                detalle: [],
                actividades: [],
                compromisos: [],
                local: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0
                },
                newArea: {'dni':'','abreviatura': '','telefono': '','correo': '','area_id': '0','local_id': '0'},
                fillDetalle: {'id':'','idactividad':'','fec_ini1': '','fec_ini': '','fec_fin1': '','fec_fin': '','observaciones': '','actividad': '','objetivo': '','indicador': '','meta': '','evidencia': '','logrosintermedios': '','nivelogro': 'A','nivelogroalcanzado': '','puntuacion': '','horas': '8','dia': ''},
                fillArea: {'id':'','dni': '','apellidosnombres': '','escalafon': '','reglaboral': '','dependencia': '','cargo': '','medicacion': '','enlace': ''},
                errors: [],
                banderaActividad:'',
                buscar:'',
                thispage:'1',
                offset: 3,
            },
            computed: {

                isActived: function(){
                    return this.pagination.current_page;
                },
                pagesNumber: function(){
                    if (!this.pagination.to) {
                        return []
                    }

                    var from = this.pagination.current_page - this.offset;
                    if (from < 1 ) {
                        from=1;
                    }

                    var to = from + (this.offset * 2);
                    if (to>=this.pagination.last_page) {
                        to = this.pagination.last_page;
                    }

                    var pagesArray = [];
                    while(from <= to){
                        pagesArray.push(from);
                        from++;
                    }
                    return pagesArray;
                }
            },
            methods:{
                
                getArea: function () {
                    this.fillArea.dni="";
                    this.fillArea.cargo="";
                    this.fillArea.apellidosnombres="";
                    this.fillArea.dependencia="";
                    this.fillArea.medicacion="";
                    $("#dni").focus();
                },
                buscarBtn: function () {
                    this.getArea();
                    this.thispage='1';
                },
                consultarDatos: function(){
                    
                    var doc = $('#dni').val();
                    // console.log(doc.trim().length);
                    if(doc==0){
                        
                        $('#dni').focus();
                        alertify.set({ delay: 3500 });
                        alertify.success("Ingrese su DNI");

                    }else{
                        if (doc.trim().length==8) {
                            var url = "anexo04/"+doc;

                            axios.get(url).then(response => {

                                if (response.data.resultado==0) {

                                    alertify.set({ delay: 3500 });
                                    alertify.error("No se ha encontrado al Personal con ese DNI");
                                    $("#dni").select();

                                }else{


                                    this.limpiar();

                                    this.fillArea.id=response.data.personal.id;
                                    this.fillArea.dni=response.data.personal.dni;
                                    this.fillArea.apellidosnombres=response.data.personal.apellidosnombres;
                                    this.fillArea.escalafon=response.data.personal.escalafon;
                                    this.fillArea.reglaboral=response.data.personal.reglaboral;
                                    this.fillArea.dependencia=response.data.personal.dependencia;
                                    this.fillArea.cargo=response.data.personal.cargo;

                                    this.detalle = response.data.detalle.data;

                                    this.pagination = response.data.pagination;

                                        if(this.detalle.length==0 && this.thispage!='1'){
                                            var a = parseInt(this.thispage) ;
                                            a--;
                                            this.thispage=a.toString();
                                            this.changePage(this.thispage);
                                        }
                                   
                                    this.activar();

                                    alertify.set({ delay: 3500 });
                                    alertify.success("Personal encontrado correctamente");
                                }

                            }).catch(error => {
                                this.errors = error.response;
                            })
                        }else{
                            $('#dni').focus();
                            alertify.set({ delay: 3500 });
                            alertify.error("Su DNI debe contener 8 dígitos");
                        }
                    }

                },
                generarAnexo04: function(id){

                    var url = 'anexo04';
                    var fecini=this.fillDetalle.fec_ini1;
                    var fecfin=this.fillDetalle.fec_fin1;

                    console.log(fecini+" - "+fecfin);

                    if (fecini.trim().length>0) {
                         if (fecfin.trim().length>0) {

                            swal({
                                  title: "Atención!",
                                  text: "Se va generar el Anexo 04 con el intervalo de fechas que ha seleccionado. ¿Desea Continuar?",
                                  icon: "warning",
                                  buttons: true,
                                  dangerMode: true,
                                })
                                .then((willDelete) => {
                                  if (willDelete) {
                                        
                                        $("#btnGenerar").attr('disabled','disabled');
                                        $("#btnCancelar").attr('disabled','disabled');

                                        axios.post(url,{
                                            id: this.fillArea.id,fec_ini: this.fillDetalle.fec_ini1,fec_fin: this.fillDetalle.fec_fin1,

                                        }).then(response => {

                                            if (response.data.resultado==1) {

                                                this.fillDetalle.id=response.data.detalle.id;
                                                this.fillDetalle.fec_ini=response.data.detalle.fec_ini;
                                                this.fillDetalle.fec_fin=response.data.detalle.fec_fin;

                                                this.detalle = response.data.detalleTabla.data;
                                                this.pagination = response.data.pagination;

                                                    if(this.detalle.length==0 && this.thispage!='1'){
                                                        var a = parseInt(this.thispage) ;
                                                        a--;
                                                        this.thispage=a.toString();
                                                        this.changePage(this.thispage);
                                                    }

                                                $("#btnGenerar").removeAttr('disabled');
                                                $("#btnCancelar").removeAttr('disabled');
                                                this.fillDetalle.fec_ini1='';
                                                this.fillDetalle.fec_fin1='';

                                                $("#mensajefinal").modal("show");
                                                alertify.set({ delay: 2000 });
                                                alertify.success("Anexo 04 registrado correctamente"); //Mensaje
                                            }

                                        }).catch(error => {
                                            this.errors = error.response.data;
                                        })
                                        
                                  }
                                });


                        }else{
                            alertify.set({ delay: 3500 });
                            alertify.error("Debe seleccionar una fecha final");
                            $("#fec_fin1").focus();
                        }
                    }else{
                        alertify.set({ delay: 3500 });
                        alertify.error("Debe seleccionar una fecha de incio");
                        $("#fec_ini1").focus();
                    }

                    

                },
                agregarActividad: function(id){

                    if (this.banderaActividad=='modificar') {
                        this.updateActividad();
                    }else{
                        
                        var url = 'actividad';

                        var actividad=this.fillDetalle.actividad;
                        var dia=this.fillDetalle.dia;
                        var horas=this.fillDetalle.horas;
                        var objetivo=this.fillDetalle.objetivo;
                        var indicador=this.fillDetalle.indicador;
                        var meta=this.fillDetalle.meta;
                        var evidencia=this.fillDetalle.evidencia;
                        var logrosintermedios=this.fillDetalle.logrosintermedios;
                        var nivelogro=this.fillDetalle.nivelogro;
                        var valorasignado='';

                        if (nivelogro=="A") {
                            valorasignado='100%';
                        }
                        if (nivelogro=="B") {
                            valorasignado='95%';
                        }
                        if (nivelogro=="C") {
                            valorasignado='70%';
                        }
                        if (nivelogro=="D") {
                            valorasignado='40%';
                        }
                        if (nivelogro=="E") {
                            valorasignado='10%';
                        }
                        var pesoasignado='100%';

                        var nivelogroalcanzado=this.fillDetalle.nivelogroalcanzado;
                        var puntuacion=this.fillDetalle.puntuacion;
                        var detalle_id=id;


                        if (actividad.trim().length>0) {
                             if (dia.trim().length>0) {
                                if (horas.trim().length>0) {
                                    if (objetivo.trim().length>0) {
                                        if (indicador.trim().length>0) {
                                            if (meta.trim().length>0) {
                                                if (evidencia.trim().length>0) {
                                                    if (logrosintermedios.trim().length>0) {
                                                        if (nivelogro.trim().length>0) {
                                                            if (nivelogroalcanzado.trim().length>0) {
                                                                if (puntuacion.trim().length>0) {

                                                                        $("#anadirActividad").attr('disabled','disabled');

                                                                        axios.post(url,{
                                                                            detalle_id: detalle_id,actividad: this.fillDetalle.actividad,dia: this.fillDetalle.dia,horas: this.fillDetalle.horas,objetivo: this.fillDetalle.objetivo,indicador: this.fillDetalle.indicador,meta: this.fillDetalle.meta,evidencia: this.fillDetalle.evidencia,logrosintermedios: this.fillDetalle.logrosintermedios,nivelogro: this.fillDetalle.nivelogro,valorasignado: valorasignado,pesoasignado: pesoasignado,nivelogroalcanzado: this.fillDetalle.nivelogroalcanzado,puntuacion: this.fillDetalle.puntuacion,

                                                                        }).then(response => {

                                                                            // if (response.data.resultado==1) {
                                                                                this.fillDetalle.id=response.data.detalle_id;
                                                                                this.actividades = response.data.actividades;
                                                                                this.limpiarActividad();
                                                                                $("#anadirActividad").removeAttr('disabled');
                                                                                alertify.set({ delay: 2000 });
                                                                                alertify.success("Actividad registrada correctamente"); //Mensaje
                                                                            // }

                                                                        }).catch(error => {
                                                                            this.errors = error.response.data;
                                                                        })
                                                                                
                                                                        


                                                                }else{
                                                                    alertify.set({ delay: 3500 });
                                                                    alertify.error("Debe ingresar la puntuación final de su actividad");
                                                                    $("#puntuacion").focus();
                                                                }
                                                            }else{
                                                                alertify.set({ delay: 3500 });
                                                                alertify.error("Debe ingresar el nivel de logro alcanzado de su actividad");
                                                                $("#nivelogroalcanzado").focus();
                                                            }
                                                        }else{
                                                            alertify.set({ delay: 3500 });
                                                            alertify.error("Debe seleccionar el nivel de logro esperado de su actividad");
                                                            $("#nivelogro").focus();
                                                        }
                                                    }else{
                                                        alertify.set({ delay: 3500 });
                                                        alertify.error("Debe ingresar los logros intermedios de su actividad");
                                                        $("#logrosintermedios").focus();
                                                    }
                                                }else{
                                                    alertify.set({ delay: 3500 });
                                                    alertify.error("Debe ingresar la evidencia de su actividad");
                                                    $("#evidencia").focus();
                                                }
                                            }else{
                                                alertify.set({ delay: 3500 });
                                                alertify.error("Debe ingresar la meta a la que suma su actividad");
                                                $("#meta").focus();
                                            }
                                        }else{
                                            alertify.set({ delay: 3500 });
                                            alertify.error("Debe ingresar el indicador al que suma su actividad");
                                            $("#indicador").focus();
                                        }
                                    }else{
                                        alertify.set({ delay: 3500 });
                                        alertify.error("Debe ingresar el objetivo al que aporta su actividad");
                                        $("#objetivo").focus();
                                    }
                                }else{
                                    alertify.set({ delay: 3500 });
                                    alertify.error("Debe seleccionar las horas que ocupó para realizar su actividad");
                                    $("#horas").focus();
                                }
                            }else{
                                alertify.set({ delay: 3500 });
                                alertify.error("Debe seleccionar el día que realizó su actividad");
                                $("#dia").focus();
                            }
                        }else{
                            alertify.set({ delay: 3500 });
                            alertify.error("Debe ingresar su actividad realizada");
                            $("#actividad").focus();
                        }

                    }


                    

                },
                updateActividad: function(){
 
                    var url = 'actividad/'+this.fillDetalle.idactividad;

                    var valorasignado='';

                        if (this.fillDetalle.nivelogro=="A") {
                            valorasignado='100%';
                        }
                        if (this.fillDetalle.nivelogro=="B") {
                            valorasignado='95%';
                        }
                        if (this.fillDetalle.nivelogro=="C") {
                            valorasignado='70%';
                        }
                        if (this.fillDetalle.nivelogro=="D") {
                            valorasignado='40%';
                        }
                        if (this.fillDetalle.nivelogro=="E") {
                            valorasignado='10%';
                        }
                        var pesoasignado='100%';


                    var data = new  FormData();
                    data.append('detalle_id', this.fillDetalle.id);
                    data.append('actividad', this.fillDetalle.actividad);
                    data.append('dia', this.fillDetalle.dia);
                    data.append('horas', this.fillDetalle.horas);
                    data.append('objetivo', this.fillDetalle.objetivo);
                    data.append('meta', this.fillDetalle.meta);
                    data.append('evidencia', this.fillDetalle.evidencia);
                    data.append('logrosintermedios', this.fillDetalle.logrosintermedios);
                    data.append('nivelogro', this.fillDetalle.nivelogro);
                    data.append('nivelogroalcanzado', this.fillDetalle.nivelogroalcanzado);
                    data.append('puntuacion', this.fillDetalle.puntuacion);
                    data.append('valorasignado', valorasignado);
                    data.append('pesoasignado', pesoasignado);
                    data.append('_method', 'PUT');
                    const config = { headers: { 'Content-Type': 'multipart/form-data' } };

                    axios.post(url, data, config).then(response => {
                            this.actividades = response.data.actividades;
                            this.limpiarActividad();
                            alertify.set({ delay: 3500 });
                            alertify.success("Editado Satisfactoriamente");
                    });

                },
                modificarActividad: function(actividad){

                    var url = 'actividad/'+actividad.id+'/edit';

                    axios.get(url).then(response => {

                        this.fillDetalle.idactividad=response.data.detalle.id;
                        this.fillDetalle.actividad=response.data.detalle.actividad;
                        this.fillDetalle.dia=response.data.detalle.dia;
                        this.fillDetalle.horas=response.data.detalle.horas;
                        this.fillDetalle.objetivo=response.data.detalle.objetivo;
                        this.fillDetalle.indicador=response.data.detalle.indicador;
                        this.fillDetalle.meta=response.data.detalle.meta;
                        this.fillDetalle.evidencia=response.data.detalle.evidencia;
                        this.fillDetalle.logrosintermedios=response.data.detalle.logrosintermedios;
                        this.fillDetalle.nivelogro=response.data.detalle.nivelogro;
                        this.fillDetalle.nivelogroalcanzado=response.data.detalle.nivelogroalcanzado;
                        this.fillDetalle.puntuacion=response.data.detalle.puntuacion;

                        this.banderaActividad='modificar';
                        $("#anadirActividad").val("Editar");

                     
                    });

                },
                deleteActividad: function(actividad){

                    var url = 'actividad/' + actividad.id;

                    swal({
                          title: "Atención!",
                          text: "Va a Eliminar la Actividad. ¿Desea Continuar?",
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            
                            axios.delete(url).then(response => {  
                        
                                // if (response.data.resultado==1) {
                                    this.actividades = response.data.actividades;
                                    this.limpiarActividad();
                                    alertify.set({ delay: 2000 });
                                    alertify.success("Actividad eliminada correctamente"); //Mensaje
                                // }
                            });
                            
                        }
                    });

                },
                cargarDetalleGeneral: function(detalles){

                    var url = 'anexo04/'+detalles.id+'/edit';

                    axios.get(url).then(response => {

                        this.fillDetalle.id=response.data.detalle.id;
                        this.fillDetalle.fec_ini=response.data.detalle.fec_ini;
                        this.fillDetalle.fec_fin=response.data.detalle.fec_fin;

                        this.actividades = response.data.actividades;
                        this.limpiarActividad();
                    
                        $('#mensajefinal').modal('show');
                     
                    });

                },
                limpiar: function(){

                    this.fillArea.id='';
                    this.fillArea.dni='';
                    this.fillArea.apellidosnombres='';
                    this.fillArea.escalafon='';
                    this.fillArea.reglaboral='';
                    this.fillArea.dependencia='';
                    this.fillArea.cargo='';

                },
                limpiarActividad: function(){

                    this.fillDetalle.actividad='';
                    this.fillDetalle.dia='';
                    this.fillDetalle.horas='8';
                    this.fillDetalle.objetivo='';
                    this.fillDetalle.indicador='';
                    this.fillDetalle.meta='';
                    this.fillDetalle.evidencia='';
                    this.fillDetalle.logrosintermedios='';
                    this.fillDetalle.nivelogro='A';
                    this.fillDetalle.nivelogroalcanzado='';
                    this.fillDetalle.puntuacion='';
                    $("#anadirActividad").val("Añadir");

                },
                activar: function(){

                    $("#divdatospersonales").css("background-color", "#ffffff");
                    $("#divAnexosGenerados").css("background-color", "#ffffff");
                    $("#divbotones").css("background-color", "#ffffff");
                    $("#btnGenerar").removeAttr('disabled');
                    $("#btnCancelar").removeAttr('disabled');
                },
                cancelar: function(){

                    this.limpiar();

                    $("#divdatospersonales").css("background-color", "#f4f4f4");
                    $("#divAnexosGenerados").css("background-color", "#f4f4f4");
                    $("#divbotones").css("background-color", "#f4f4f4");
                    $("#btnGenerar").attr('disabled', true);
                    $("#btnCancelar").attr('disabled', true);
                    $("#dni").focus();

                },
                vermodal: function(){

                    $("#mensajefinal").modal("show");
                }
                
            }
            
        });

</script>

    <script>
        $(document).ready(function(){

            $("#dni").focus();
          
        });

    function soloNumeros(e){
      var key = window.Event ? e.which : e.keyCode
      return ((key >= 48 && key <= 57) || (key==8) || (key==35) || (key==34) || (key==46));
    }


    </script>
</body>

@endsection
