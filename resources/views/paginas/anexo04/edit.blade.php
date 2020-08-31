<form method="POST" v-on:submit.prevent="updateAnexo4acti(fillAnexo4.id)" id="updateAnexo4">

  {{ csrf_field() }}
  {{ method_field("PUT") }}
    
<div class="modal fade" id="edit">
          <div class="modal-dialogxl">
            <div class="modal-content">
              <div class="modal-header panel panel-primary" style="background-color: #337ab7;border-color: #337ab775;margin-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-size: 14px;color: white;font-weight: bold;">Anexos 04 Generados para el periodo <b style="font-size: 15px;text-decoration: underline;">@{{ fillAnexo4.fec_ini }} al @{{ fillAnexo4.fec_fin }}</b></h4>
              </div>
              <div class="modal-body box-body">

                <div id="cuerporActividadesEdit">

                 <!--  <div v-for="(activids, index) in anexos4Actividades" class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                    
                    <div class="col-sm-12 box box-warning" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f3f3f3bf;margin-bottom: 15px;padding-bottom: 15px;border-top-color: #ff7701;">
                      <div class="box-header with-border" style="padding-bottom: 0px;padding-top: 0px;">
                        <div class="form-group" style="padding-top: 10px;">
                          <label for="area" class="col-sm-6 control-label" style="margin-bottom: 0px;padding-top: 5px;text-align: left;padding-right: 0px;font-weight: bold;padding-left: 0px;">
                            <span class="badge bg-orange" style="font-size: 15px;">Actividades realizadas el día @{{ activids.fecha }}
                              <input type="text" v-bind:name="'idactividad'+(index+1)" v-bind:value="activids.id" style="visibility: hidden;width: 9px;height: 7px;">
                            </span>
                          </label>
                          <label for="area" class="col-sm-4 control-label" style="margin-bottom: 0px;padding-top: 5px;text-align: right;padding-right: 0px;font-weight: bold;">Tiempo laborado del día</label>
                          <div class="col-sm-2">
                            <select class="form-control" style="padding-right: 10px;padding-left: 7px;" v-bind:name="'tiempo'+(index+1)" v-model="activids.tiempo">
                              <option value="60">1 Hora</option>
                              <option value="120">2 Horas</option>
                              <option value="180">3 Horas</option>
                              <option value="240">4 Horas</option>
                              <option value="300">5 Horas</option>
                              <option value="360">6 Horas</option>
                              <option value="420">7 Horas</option>
                              <option value="480">8 Horas</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="form-group has-feedback col-sm-12" style="padding-left: 0px;padding-right: 5px;">
                          <label for="inputNombres">Descripción de Actividades</label>
                          <textarea class="textarea form-control" style="resize: none" rows="5" v-bind:id="'actividad'+(index+1)" v-bind:name="'actividad'+(index+1)">@{{ activids.actividad }}</textarea>
                        </div>
                        <div class="form-group has-feedback col-sm-12" style="padding-right: 0px;padding-left: 0px;">
                          <label for="inputDependencia">Productos Alcanzados por el Trabajador</label>
                          <textarea class="form-control" rows="3" style="resize: none" v-bind:name="'productosalcanzados'+(index+1)">@{{ activids.productosalcanzados }}</textarea>
                        </div>
                      </div>
                    </div>

                  </div> -->

                </div>

                <div class="col-md-12">
                    <div class="progress" id="divProgress" style="margin-bottom: 10px;margin-top: 0px;">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" id="proEdit" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                    </div>
                </div>

                <span v-for="error in errors" class="text-danger">@{{ error }}</span>

              </div>
              <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" v-on:click.prevent="cancelarActividadesEdit()">Cancelar</button>
                <input type="text" name="cantdiasedit" id="cantdiasedit" style="visibility: hidden;width: 9px;height: 7px;">
                <input type="submit" name="" class="btn btn-primary" value="Actualizar">

              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

</form>



