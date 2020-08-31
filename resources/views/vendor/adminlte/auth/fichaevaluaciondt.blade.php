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
    <div id="datosFicEva">

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
                            <h4>NORMAS PARA LA EVALUACIÓN DE DESEMPEÑO DE LOS TRABAJADORES JUDICIALES EN EL PODER JUDICIAL - FICHA DE EVALUACIÓN</h4>
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
                          <input type="text" class="form-control" style="font-size: 17px;" placeholder="DNI" id="dni" name="dni" onkeypress="return soloNumeros(event);" v-model="fillJefeResponsable.dni" maxlength="8" required/> 
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
                           <a href="{{ url('/fichaevaluacion') }}" id="cancelar" class="text-center btn btn-warning btn-block btn-flat">Cancelar</a>
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
                      <input type="text" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Apellidos y Nombres" id="apellidosnombres" name="apellidosnombres"  v-model="fillJefeResponsable.apellidosnombres" disabled />
                    </div>
                    <div class="form-group has-feedback col-sm-4">
                      <label for="inputDependencia">Dependencia</label>
                      <input type="text" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Dependencia" id="dependencia" name="dependencia"  v-model="fillJefeResponsable.dependencia" disabled />
                    </div>
                    <div class="form-group has-feedback col-sm-4" style="padding-right: 0px;">
                      <label for="inputCargo">Cargo</label>
                      <input type="text" style="font-size: 12px;font-weight: bold;padding-left: 6px;padding-right: 4px;" class="form-control" placeholder="Cargo" id="cargo" name="cargo"  v-model="fillJefeResponsable.cargo" disabled />
                    </div>
                </div>
            </div>

            <div class="col-sm-12 box box-danger" id="divFichasGenerados" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f4f4f4;">
                <div class="box-header with-border">
                  <h4 style="font-size: 15px;font-weight: bold;" class="box-title">Personal a cargo</h4>
                </div>
                <div class="box-body">

                   <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Apellidos y Nombres</th>
                                <th>Dependencia</th>
                                <th>Cargo</th>
                                <th>Fichas</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(personalacargos, index) in personalacargo">
                                <td width="10px" style="font-family: Arial; font-size: 12px;">@{{ index+1 }}</td>
                                <td style="font-family: Arial; font-size: 12px;">@{{ personalacargos.apellidosnombres }}</td>
                                <td style="font-family: Arial; font-size: 12px;">@{{ personalacargos.dependencia }}</td>
                                <td style="font-family: Arial; font-size: 12px;">@{{ personalacargos.cargo }}</td>
                                <td width="10px" style="text-align: center;">
                                    <a href="#" style="font-size: 15px;" data-placement="bottom" data-toggle="tooltip" title="Ver Ficha" class="btn btn-warning btn-hover-info btn-xs fa fa-book" v-on:click.prevent="cargarFichasGeneradas(personalacargos)"></a>
                                </td>
                            </tr>
                    
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row">
                
            </div>

                <div class="modal fade" id="modalFichasPersonal" tabindex="-1" role="dialog" aria-labelledby="modalDetalleobsLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header panel panel-success" style="background-color: #337ab7;border-color: #2e6da4;margin-bottom: 0px;padding-top: 10px;padding-bottom: 10px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" style="font-size: 14px;font-weight: bold;color: white;">Fichas Generadas de @{{ fillTrabajador.apellidosnombres }}</h4>
                          </div>
                          <div class="modal-body box-body" style="padding-left: 20px;padding-right: 20px;">

                            <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                                <div class="col-sm-12 box box-primary" id="divdetallegeneral" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f8f8f8;margin-bottom: 15px;">
                                    <div class="box-body">
                                        <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th>#</th>
                                                  <th>Fecha</th>
                                                  <th>Estado</th>
                                                  <th>Archivo</th>
                                                  <th>Control</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                              <tr v-for="(fichasEvaluados, index) in fichasEvaluado">
                                                  <td width="10px" style="font-family: Arial; font-size: 12px;">@{{ index+1 }}</td>
                                                  <td style="font-family: Arial; font-size: 12px;">@{{ fichasEvaluados.fecha }}</td>
                                                  <td style="font-family: Arial; font-size: 12px;">@{{ fichasEvaluados.estado }}</td>
                                                  <td style="font-family: Arial; font-size: 12px;">@{{ fichasEvaluados.archivo }}</td>
                                                  <td width="10px" style="text-align: center;">
                                                      <a href="#" style="font-size: 15px;" data-placement="bottom" data-toggle="tooltip" title="Editar Anexo" class="btn btn-warning btn-hover-info btn-xs fa fa-book" v-on:click.prevent="modificarFicha(fichasEvaluados)"></a>
                                                  </td>
                                              </tr>
                                      
                                          </tbody>
                                      </table>
                                    </div>
                                </div>
                            </div>

                            <span v-for="error in errors" class="text-danger">@{{ error }}</span>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" style="margin-left: 10px;margin-right: 5px;">Cerrar</button>
                            <a href="#" id="consultar" class="text-center btn btn-warning" v-on:click.prevent="nuevaFicha()">Nueva Ficha</a>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalFichaNueva" tabindex="-1" role="dialog" aria-labelledby="modalDetalleobsLabel" aria-hidden="true">
                    <div class="modal-dialogxl">
                        <div class="modal-content">
                          <div class="modal-header panel panel-success" style="background-color: #337ab7;border-color: #2e6da4;margin-bottom: 0px;padding-top: 10px;padding-bottom: 10px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" style="font-size: 14px;font-weight: bold;color: white;">FICHA DE EVALUACIÓN</h4>
                          </div>
                          <div class="modal-body box-body" style="padding-left: 20px;padding-right: 20px;">

                            <div class="col-md-12">
                                <div class="col-sm-12 box box-warning" id="divdetallegeneral" style="box-shadow: 0px 1px 2px 0px #8d8686;margin-bottom: 15px;">
                                    <div class="box-body" style="padding-top: 0px;">
                                        <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th colspan="3">I. IDENTIFICACIÓN</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                              <tr style="color: #000;">
                                                  <td width="20" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    <span class="badge bg-yellow">1.1</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">Nombre y Apellidos del evaluado</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">@{{ fillTrabajador.apellidosnombres }}</td>
                                              </tr>
                                              <tr style="color: #000;">
                                                  <td width="20" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    <span class="badge bg-yellow">1.2</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">Cargo</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">@{{ fillTrabajador.cargo }}</td>
                                              </tr>
                                              <tr style="color: #000;">
                                                  <td width="20" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    <span class="badge bg-yellow">1.3</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">Antigüedad en el Cargo</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">@{{ fillTrabajador.antiguedad }}</td>
                                              </tr>
                                              <tr style="color: #000;">
                                                  <td width="20" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    <span class="badge bg-yellow">1.4</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">Jefe/Supervisor/Colaborador</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">@{{ fillJefeResponsable.apellidosnombres }}</td>
                                              </tr>
                                              <tr style="color: #000;">
                                                  <td width="20" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    <span class="badge bg-yellow">1.5</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">Área</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">@{{ fillTrabajador.dependencia }}</td>
                                              </tr>
                                              <tr style="color: #000;">
                                                  <td width="20" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    <span class="badge bg-yellow">1.6</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">Gerencia</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">@{{ fillTrabajador.gerencia }}</td>
                                              </tr>
                                              <tr style="color: #000;">
                                                  <td width="20" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    <span class="badge bg-yellow">1.7</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">Fecha de Ingreso</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">@{{ fillTrabajador.fecingreso }}</td>
                                              </tr>
                                              <tr style="color: #000;">
                                                  <td width="20" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    <span class="badge bg-yellow">1.8</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">Fecha de Evaluación</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">@{{ this.fechaActual }}</td>
                                              </tr>
                                          </tbody>
                                      </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-sm-12 box box-danger" id="divdetallegeneral" style="box-shadow: 0px 1px 2px 0px #8d8686;margin-bottom: 15px;">
                                    <div class="box-body" style="padding-top: 0px;">
                                        <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th colspan="2">II. EVALUACIÓN POR COMPETENCIAS (funciones del cargo)</th>
                                                  <th width="13">Puntaje (1-10)</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                              <tr v-for="(competenciass, index) in competencias" style="color: #000;">
                                                  <td width="15" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                  <span class="badge bg-red">@{{ competenciass.nro }}</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;">@{{ competenciass.descripcion }}</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    
                                                  <select  style="width: 100%;font-family: Arial;font-size: 12px;padding-left: 5px;padding-right: 5px;padding-top: 3px;padding-bottom: 3px;height: 23px;font-weight: bold;text-align: center;" aria-hidden="true" class="form-control" @change="puntoCompetencia(index)" v-bind:id="'selectComp'+index" required>
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
                                                    </select>
                                                  </td>
                                              </tr>
                                                  <td colspan="2" style="font-family: Arial; font-size: 14px;padding-top: 4px;padding-bottom: 4px;text-align: right;vertical-align: middle;font-weight: bold;">
                                                  Subtotal (promedio):
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                    <input type="text" style="padding-top: 3px;padding-bottom: 3px;height: 23px;text-align: center;font-weight: bold;" id="promedioComp" class="form-control" disabled>
                                                  </td>
                                          </tbody>
                                      </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-sm-12 box box-success" id="divdetallegeneral" style="box-shadow: 0px 1px 2px 0px #8d8686;margin-bottom: 15px;">
                                    <div class="box-body" style="padding-top: 0px;">
                                        <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th colspan="2">III. EVALUACIÓN DE HABILIDADES</th>
                                                  <th width="13">Puntaje (1-10)</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr v-for="(habilidades, index) in habilidades" style="color: #000">
                                                  <td width="15" style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                  <span class="badge bg-green">@{{ habilidades.nro }}</span>
                                                  </td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;vertical-align: middle;"><b>@{{ habilidades.categoria }}:</b> @{{ habilidades.descripcion }}</td>
                                                  <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">

                                                    <select  style="width: 100%;font-family: Arial;font-size: 12px;padding-left: 5px;padding-right: 5px;padding-top: 3px;padding-bottom: 3px;height: 23px;font-weight: bold;text-align: center;" aria-hidden="true" class="form-control" @change="puntoHabilidad(index)" v-bind:id="'selectHabi'+index" required>
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
                                                    </select>

                                                  </td>
                                              </tr>
                                              <td colspan="2" style="font-family: Arial; font-size: 14px;padding-top: 4px;padding-bottom: 4px;text-align: right;vertical-align: middle;font-weight: bold;">
                                                  Subtotal (promedio):
                                              </td>
                                              <td style="font-family: Arial; font-size: 12px;padding-top: 4px;padding-bottom: 4px;text-align: center;vertical-align: middle;">
                                                <input type="text" style="padding-top: 3px;padding-bottom: 3px;height: 23px;text-align: center;font-weight: bold;" id="promedioHabili" class="form-control" disabled>
                                              </td>
                                          </tbody>
                                      </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-sm-12 box box-default" id="divdetallegeneral" style="box-shadow: 0px 1px 2px 0px #8d8686;margin-bottom: 15px;">
                                    <div class="box-body" style="padding-top: 0px;padding-bottom: 0px;">
                                        <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <td style="vertical-align: middle;text-align: right;color: #484848;">
                                                    <input type="text" style="height: 23px;text-align: right;font-weight: bold;border: solid 0px #ccc0;width: 100%" id="msjdesempeno" readonly>
                                                  </td>
                                                  <td width="80" style="vertical-align: middle;text-align: center;">
                                                    <div id="imagenEvaluacion"></div>
                                                  </td>
                                                  <td width="200" style="vertical-align: middle;color: #484848;font-weight: bold;text-align: right;">PROMEDIO GENERAL</td>
                                                  <td width="70" style="vertical-align: middle;color: #000;">
                                                    <input type="text" style="padding-top: 3px;padding-bottom: 3px;height: 23px;text-align: center;font-weight: bold;" id="promedioGen" class="form-control" disabled>
                                                  </td>
                                              </tr>
                                          </thead>
                                      </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-sm-12 box box-primary" id="divdetallegeneral" style="box-shadow: 0px 1px 2px 0px #8d8686;margin-bottom: 15px;">
                                    <div class="box-header with-border" style="padding-bottom: 7px;">
                                      <h4 style="font-size: 15px;font-weight: bold;" class="box-title">IV. METAS Y OBJETIVOS PARA LA PRÓXIMA EVALUACIÓN:</h4>
                                    </div>
                                    <div class="box-body" style="padding-top: 0px;padding-bottom: 20px;">
                                        <input type="text" style="font-size: 12px;font-weight: bold;padding-left: 2px;padding-right: 0px;" class="form-control" id="metasproxevaluacion" name="metasproxevaluacion" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-sm-12 box box-info" id="divdetallegeneral" style="box-shadow: 0px 1px 2px 0px #8d8686;margin-bottom: 15px;">
                                    <div class="box-header with-border" style="padding-bottom: 7px;">
                                      <h4 style="font-size: 15px;font-weight: bold;" class="box-title">V. CAPACITACIÓN SUGERIDA/NECESARIA:</h4>
                                    </div>
                                    <div class="box-body" style="padding-top: 0px;padding-bottom: 20px;">
                                        <input type="text" style="font-size: 12px;font-weight: bold;padding-left: 2px;padding-right: 0px;" class="form-control" id="capacitacion" name="capacitacion" />
                                    </div>
                                </div>
                            </div>

                            <span v-for="error in errors" class="text-danger">@{{ error }}</span>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" style="margin-left: 10px;margin-right: 5px;">Cerrar</button>
                            <a href="#" id="consultar" class="text-center btn btn-primary" v-on:click.prevent="guardarFichaBorrador()">Guardar como Borrador</a>
                            <a href="#" id="consultar" class="text-center btn btn-warning" v-on:click.prevent="guardarFicha()">Guardary Generar Ficha</a>
                          </div>
                        </div>
                    </div>
                </div>

        </form>
       
    </div>

    </div>
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

    <script>
                                         
    app = new Vue({

            el: '#datosFicEva',
            created: function(){
                this.getArea();
            },
            data: {
                personalacargo: [],
                fichasEvaluado: [],
                competencias: [],
                habilidades: [],
                local: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0
                },
                newArea: {'subtotalc':'0','subtotalh': '0'},
                fillJefeResponsable: {'id':'','dni': '','apellidosnombres': '','escalafon': '','reglaboral': '','dependencia': '','cargo': ''},
                fillTrabajador: {'id':'','dni': '','apellidosnombres': '','cargo': '','dependencia': ''},
                errors: [],
                tipoPersonal:'',
                fechaActual:'',
                totalCompe:0,
                contComp:0,
                totalHabili:0,
                contHabili:0,
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
                    this.fillJefeResponsable.dni="43946485";
                    this.fillJefeResponsable.cargo="";
                    this.fillJefeResponsable.apellidosnombres="";
                    this.fillJefeResponsable.dependencia="";
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
                            var url = "rfichaevaluacion/"+doc;

                            axios.get(url).then(response => {

                                if (response.data.resultado==0) {

                                    alertify.set({ delay: 3500 });
                                    alertify.error("No se ha encontrado al Personal con ese DNI");
                                    $("#dni").select();

                                }else{


                                    this.limpiar();

                                    this.fillJefeResponsable.id=response.data.personal.id;
                                    this.fillJefeResponsable.dni=response.data.personal.dni;
                                    this.fillJefeResponsable.apellidosnombres=response.data.personal.apellidosnombres;
                                    this.fillJefeResponsable.escalafon=response.data.personal.escalafon;
                                    this.fillJefeResponsable.reglaboral=response.data.personal.reglaboral;
                                    this.fillJefeResponsable.dependencia=response.data.personal.dependencia;
                                    this.fillJefeResponsable.cargo=response.data.personal.cargo;
                                    this.tipoPersonal=response.data.personal.jeferesponsable;

                                    this.personalacargo = response.data.personalacargo;
                                   
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
                cargarFichasGeneradas: function(personalcargo){

                    var url = 'rfichaevaluacion/'+personalcargo.id+'/edit';

                    axios.get(url).then(response => {

                        if (response.data.resultado==0) {

                            alertify.set({ delay: 3500 });
                            alertify.error("No se ha encontrado al Personal");
                            $("#dni").select();

                        }else{
                            
                            this.fillTrabajador.id=response.data.evaluado.id;
                            this.fillTrabajador.dni=response.data.evaluado.dni;
                            this.fillTrabajador.apellidosnombres=response.data.evaluado.apellidosnombres;
                            this.fillTrabajador.cargo=response.data.evaluado.cargo;
                            this.fillTrabajador.dependencia=response.data.evaluado.dependencia;

                            this.fichasEvaluado = response.data.fichasEvaluado;
                            $('#modalFichasPersonal').modal('show');
                        }

                    });

                },
                nuevaFicha: function(){
                    var tipoPers='';

                    if (this.tipoPersonal==1) {
                      tipoPers='trabajador';
                    }
                    if (this.tipoPersonal==2) {
                      tipoPers='directivo';
                    }

                    var url = 'rfichaevaluacion/'+tipoPers+'/create';

                    axios.get(url).then(response => {

                            this.competencias = response.data.competencias;
                            this.habilidades = response.data.habilidades;
                            this.fechaActual=response.data.fechaActual;
                            this.totalCompetencias();
                            this.totalHabilidades();
                            $('#modalFichaNueva').modal('show');
                    });

                },
                puntoCompetencia: function(index){
                  var ptoc=$("#selectComp"+index).val();
                      this.competencias[index].puntosc=ptoc;
                      this.totalCompetencias();

                },
                totalCompetencias: function(){
                    this.totalCompe=0;
                    this.contComp=0;
                    for (competencia of this.competencias) {
                        this.totalCompe=parseInt(this.totalCompe)+parseInt(competencia.puntosc);
                        this.contComp++;
                    }

                    this.totalCompe=(this.totalCompe/this.contComp)
                    $("#promedioComp").val(this.totalCompe);
                    this.promedioGeneral();

                },
                puntoHabilidad: function(index){
                  var ptoh=$("#selectHabi"+index).val();
                      this.habilidades[index].puntosh=ptoh;
                      this.totalHabilidades();

                },
                totalHabilidades: function(){
                    this.totalHabili=0;
                    this.contHabili=0;
                    for (habilidad of this.habilidades) {
                        this.totalHabili=parseInt(this.totalHabili)+parseInt(habilidad.puntosh);
                        this.contHabili++;
                    }

                    this.totalHabili=(this.totalHabili/this.contHabili)
                    $("#promedioHabili").val(this.totalHabili);
                    this.promedioGeneral();

                },
                promedioGeneral: function(){

                    var promGeneral=(0.6*(this.totalCompe))+(0.4*(this.totalHabili));
                    $("#promedioGen").val(promGeneral);

                    if (promGeneral>=1.0 && promGeneral<=4.9) {
                      $("#msjdesempeno").val("Desempeño Deficiente (DD), capacitación necesaria");
                      $("#imagenEvaluacion").empty();
                      $("#imagenEvaluacion").append('<img class="img-circle" src="img/deficiente.png" alt="User Avatar" width="55">');

                    }
                    if (promGeneral>=5 && promGeneral<=6.9) {
                      $("#msjdesempeno").val("Desempeño Regular (DR), capacitación sugerida");
                      $("#imagenEvaluacion").empty();
                      $("#imagenEvaluacion").append('<img class="img-circle" src="img/regular.png" alt="User Avatar" width="55">');
                    }
                    if (promGeneral>=7 && promGeneral<=8.9) {
                      $("#msjdesempeno").val("Desempeño Bueno (DB)");
                      $("#imagenEvaluacion").empty();
                      $("#imagenEvaluacion").append('<img class="img-circle" src="img/bueno.png" alt="User Avatar" width="55">');
                    }
                    if (promGeneral>=9 && promGeneral<=9.4) {
                      $("#msjdesempeno").val("Desempeño Muy Bueno (DMB)");
                      $("#imagenEvaluacion").empty();
                      $("#imagenEvaluacion").append('<img class="img-circle" src="img/muybueno.png" alt="User Avatar" width="55">');
                    }
                    if (promGeneral>=9.5 && promGeneral<=10) {
                      $("#msjdesempeno").val("Desempeño Sobresaliente (DS)");
                      $("#imagenEvaluacion").empty();
                      $("#imagenEvaluacion").append('<img class="img-circle" src="img/sobresaliente.png" alt="User Avatar" width="55">');
                    }
                },
                limpiar: function(){

                    this.fillJefeResponsable.id='';
                    this.fillJefeResponsable.dni='';
                    this.fillJefeResponsable.apellidosnombres='';
                    this.fillJefeResponsable.escalafon='';
                    this.fillJefeResponsable.reglaboral='';
                    this.fillJefeResponsable.dependencia='';
                    this.fillJefeResponsable.cargo='';

                },
                activar: function(){

                    $("#divdatospersonales").css("background-color", "#ffffff");
                    $("#divFichasGenerados").css("background-color", "#ffffff");
                },
                cancelar: function(){

                    this.limpiar();

                    $("#divdatospersonales").css("background-color", "#f4f4f4");
                    $("#divFichasGenerados").css("background-color", "#f4f4f4");
                    $("#dni").focus();

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
          return ((key >= 48 && key <= 57));
        }


    </script>
</body>

@endsection
