<form method="POST" v-on:submit.prevent="createAnexo04" id="crearAnexo4">
{{ csrf_field() }}

<!-- <div class="modal fade" id="create"> -->
<div class="modal" id="create">
          <div class="modal-dialogxl">
            <div class="modal-content">
              <div class="modal-header panel panel-warning" style="background-color: #337ab7;border-color: #337ab775;margin-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-weight: bold;color: #fff">Generar Nuevo Anexo 04</h4>
              </div>
              <div class="modal-body box-body">

                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                    <div class="col-sm-12 box box-primary" id="divcompromiso" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f3f3f3bf;margin-bottom: 15px;padding-bottom: 15px;">
                        <div class="box-header with-border" style="padding-bottom: 0px;">
                          <h4 style="font-size: 15px;font-weight: bold;" class="box-title">Periodo de Evaluacion</h4>
                        </div>
                        
                        <div class="form-group" style="padding-top: 10px;">
                            <label for="area" class="col-sm-2 control-label" style="margin-bottom: 0px;padding-top: 5px;text-align: right;padding-right: 0px;">Fecha Inicio</label>
                            <div class="col-sm-3">
                                <input type="date" style="border-radius: 2px" class="form-control" id="fec_ini" name="fec_ini"  v-model="newAnexo4.fec_ini" required>
                            </div>
                            <label for="area" class="col-sm-2 control-label" style="margin-bottom: 0px;padding-top: 5px;text-align: right;padding-right: 0px;">Fecha Final</label>
                            <div class="col-sm-3">
                                <input type="date" style="border-radius: 2px" class="form-control" id="fec_fin" name="fec_fin"  v-model="newAnexo4.fec_fin" required>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-danger" v-on:click.prevent="agregarActividades()"><i class="fa fa-mail-forward"></i> Generar</button>
                               <!-- <a style="font-size: 13px;" href="#" class="btn btn-danger btn-hover-info btn-sm" v-on:click.prevent="agregarActividades()">Generar</a> -->

                            </div>
                        </div>
                    </div>
                </div>

                <div id="cuerporActividades"></div>
                
                <div class="col-md-12">
                    <div class="progress" id="divProgress" style="margin-bottom: 10px;margin-top: 0px;">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" id="pro" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                    </div>
                </div>

                <span v-for="error in errors" class="text-danger">@{{ error }}</span>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" v-on:click.prevent="cancelarActividades()">Cancelar</button>
                <input type="text" name="cantdias" id="cantdias" style="visibility: hidden;width: 9px;height: 7px;">
                <input type="submit" name="" class="btn btn-primary" value="Guardar">
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        

</form>