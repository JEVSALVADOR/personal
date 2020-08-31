<form method="POST" v-on:submit.prevent="enviarAnexo4(fillAnexo4.id)" id="enviarAnexo4">
    
<div class="modal fade" id="previsualizaAnexo4">
          <div class="modal-dialogxl">
            <div class="modal-content">
              <div class="modal-header panel panel-primary" style="background-color: #00a65a;border-color: #00a65a;margin-bottom: 0px;border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" style="font-size: 14px;color: white;font-weight: bold;">
                    Anexo 04 Generado para el periodo <span class="label label-warning" style="font-size: 14px;font-weight: bold;">@{{ fillAnexo4.fec_ini }} / @{{ fillAnexo4.fec_fin }}</span>
                  </h4>
              </div>
                  <tr>
                    <div class="progress progress-xs progress-striped active" style="border-radius: 0px;height: 7px;margin-bottom: 0px;">
                      <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                    </div>
                  </tr>
              <div class="modal-body box-body">

                <div id="cuerporActividadesSend">
                  <!-- <embed v-bind:src="'{{ url('/') }}/generarAnexo04/'+fillAnexo4.id" style="width: 100%" height="375"> -->
                </div>
                
                <span v-for="error in errors" class="text-danger">@{{ error }}</span>

              </div>
              <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" v-on:click.prevent="cancelarActividadesSend()">Cancelar</button>
                <input type="submit" name="" class="btn btn-primary" value="Enviar">

              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

</form>