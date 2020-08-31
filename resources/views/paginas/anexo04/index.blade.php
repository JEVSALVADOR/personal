 <div class="container-fluid spark-screen" id="anexo4">

	<div class="box box-primary">

	    <div class="box-header with-border" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;border-bottom: 1.8px solid #f4f4f4;">

            <div class="col-sm-7">
               <h3 class="box-title" style="padding-top: 4px;padding-bottom: 4px;"><span class="badge bg-aqua" style="font-size: 17px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;">Generar Anexos 04 (Formato de Evaluación de Trabajo)</span></h3>
            </div>
            <div class="col-sm-3">
                <input type="text" placeholder="Buscar" style="border-radius: 2px" class="form-control" v-model="buscar" @keyup="buscarBtn()">
            </div>
            <div class="col-sm-2">
               <a href="#" class="btn btn-primary pull-right" v-on:click.prevent="generarActividades()">Generar Nuevo Anexo 04</a>
            </div>
        </div>

	    <div class="box-body" style="padding-left: 20px;padding-right: 20px;padding-top: 15px;padding-bottom: 20px;">
	      	<table class="table table-striped">
	      		<thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th style="text-align: center;">Estado</th>
                        <th style="text-align: center;">Control</th>
                    </tr>
                </thead>
		        <tbody>

			        <tr v-for="(anexs4, index) in anexos4">
                        <td width="10px" style="font-family: Arial; font-size: 12px;">@{{ index+pagination.from }}</td>
                        <td style="font-family: Arial; font-size: 12px;">@{{ anexs4.fec_ini }}</td>
                        <td style="font-family: Arial; font-size: 12px;">@{{ anexs4.fec_fin }}</td>

                        <td v-if="anexs4.estado==0" style="text-align: center;font-family: Arial; font-size: 12px;vertical-align: middle;">
                            <span class="badge bg-yellow">Generado</span>
                        </td>
  
                        <td width="350px" style="text-align: center;">

                            <button type="button" class="btn btn-warning" v-on:click.prevent="editarActividades(anexs4)"><i class="fa fa-pencil"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" v-on:click.prevent="eliminarAnexo(anexs4)"><i class="fa fa-trash"></i> Eliminar</button>
                            <button type="button" class="btn btn-success" v-on:click.prevent="enviarAnexo(anexs4)"><i class="fa fa-share"></i> Enviar Anexo</button>

                        </td>
                    </tr>
	        
	      		</tbody>
	  		</table>
	    </div>
	    <!-- /.box-body -->
	    <div class="box-footer clearfix" style="padding-bottom: 15px;padding-top: 15px;padding-right: 20px;">
	      	<ul class="pagination pagination-sm no-margin pull-right">
                <li class="page-item" v-if="pagination.current_page>1">
                   <a class="page-link" href="#" @click.prevent="changePage(1)">
                    <span><b>Inicio</b></span>
                  </a>
                </li>
	            <li v-if="pagination.current_page > 1">
	                <a href="#" @click.prevent="changePage(pagination.current_page - 1)">
	                    <span>Atras</span>
	                </a>
	            </li>
	            <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
	                <a href="#" @click.prevent="changePage(page)">
	                    @{{ page }}
	                </a>
	            </li>
	            <li v-if="pagination.current_page < pagination.last_page">
	                <a href="#" @click.prevent="changePage(pagination.current_page + 1)">
	                    <span>siguiente</span>
	                </a>
	            </li>
                <li class="page-item" v-if="pagination.current_page< pagination.last_page">
                 <a class="page-link" href="#" @click.prevent="changePage(pagination.last_page)">
                  <span><b>Ultima</b></span>
                </a>
                </li>
        	</ul>
	    </div>

	  </div>
	
	@include('paginas.anexo04.create')
    @include('paginas.anexo04.edit')
    @include('paginas.anexo04.send')

</div>

<script>
                                         
    app = new Vue({

            el: '#anexo4',
            created: function(){
                this.getArea();
            },
            data: {
                anexos4: [],
                anexos4Actividades: [],
                anexos4ActividadesSend: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0
                },
                newAnexo4: {'id':'','fec_ini': '','fec_fin': '','fec_fijacion_metas': '','evaluador_id': '','evaluado_id': '','observaciones': '','fec_suscripcion': '','estado': '','archivo': '','promedionivlogro': ''},
                fillAnexo4: {'id':'','fec_ini':'','fec_fin':''},
                errors: [],
                buscar:'',
                dias:'',
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
                getArea: function(page){
                    var urlAreas = 'ranexo04?page='+page+'&buscar='+this.buscar;
                    axios.get(urlAreas).then(response => {

                        this.anexos4 = response.data.anexos4.data;
                        this.pagination = response.data.pagination;
                        if(this.anexos4.length==0 && this.thispage!='1'){
                            var a = parseInt(this.thispage) ;
                            a--;
                            this.thispage=a.toString();
                            this.changePage(this.thispage);
                        }

                    });
                },
                buscarBtn: function () {
                    this.getArea();
                    this.thispage='1';
                },
                generarActividades: function(persanexo){

                    this.cancelarActividades();
                    $("#create").modal("show");

                },
                agregarActividades: function(persanexo){

                    if (this.newAnexo4.fec_ini=='') {
                        alertify.set({ delay: 4500 });
                        alertify.error("Seleccione una fecha de Inicio");
                        $("#fec_ini").focus();

                    }else{

                        if (this.newAnexo4.fec_fin=='') {
                            alertify.set({ delay: 4500 });
                            alertify.error("Seleccione una fecha final");
                            $("#fec_fin").focus();

                        }else{

                            this.dias = this.calcularDias( Date.parse(this.newAnexo4.fec_ini), Date.parse(this.newAnexo4.fec_fin));
                            if (parseInt(this.dias)<=0) {

                                alertify.set({ delay: 4500 });
                                alertify.error("La fecha de inicio debe ser menor a la fecha final");
                                $("#fec_ini").focus();

                            }else{
                                var anio=(this.newAnexo4.fec_ini).substr(0, 4);
                                var mes=(this.newAnexo4.fec_ini).substr(5, 2);
                                var dia=(this.newAnexo4.fec_ini).substr(8, 2);

                                for (var i = 1; i <= parseInt(this.dias); i++) {
                                    if (i>1) {
                                        dia=parseInt(dia)+1;
                                    }

                                    $("#cuerporActividades").append('<div class="col-md-12" style="padding-left: 0px;padding-right: 0px;"><div class="col-sm-12 box box-warning" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f3f3f3bf;margin-bottom: 15px;padding-bottom: 15px;"><div class="box-header with-border" style="padding-bottom: 0px;padding-top: 0px;"><div class="form-group" style="padding-top: 10px;"><label for="area" class="col-sm-6 control-label" style="margin-bottom: 0px;padding-top: 5px;text-align: left;padding-right: 0px;font-weight: bold;padding-left: 0px;"><span class="badge bg-yellow" style="font-size: 15px;">Actividades realizadas el día '+dia+"-"+mes+"-"+anio+'<input type="text" name="fecha'+i+'" id="fecha'+i+'" value="'+anio+"-"+mes+"-"+dia+'" style="visibility: hidden;width: 9px;height: 7px;"></span></label><label for="area" class="col-sm-4 control-label" style="margin-bottom: 0px;padding-top: 5px;text-align: right;padding-right: 0px;font-weight: bold;">Tiempo laborado del día</label><div class="col-sm-2"><select class="form-control" style="padding-right: 10px;padding-left: 7px;color: #000;" id="tiempo'+i+'" name="tiempo'+i+'"><option value="60">1 Hora</option><option value="120">2 Horas</option><option value="180">3 Horas</option><option value="240">4 Horas</option><option value="300">5 Horas</option><option value="360">6 Horas</option><option value="420">7 Horas</option><option value="480" selected>8 Horas</option></select></div></div></div><div class="box-body" style="border: solid 1px #b3b3b3;margin-top: 10px;padding-bottom: 0px;"><div class="form-group has-feedback col-sm-12" style="padding-left: 0px;padding-right: 5px;"><label for="inputNombres"><b>Descripción de Actividades</b></label><textarea class="form-control" rows="6" id="actividad'+i+'" name="actividad'+i+'" placeholder="Descripción de las actividades realizadas..." style="resize: none"></textarea></div></div><div class="box-body" style="border: solid 1px #b3b3b3;margin-top: 10px;padding-bottom: 0px;"><div class="form-group has-feedback col-sm-12" style="padding-right: 0px;padding-left: 0px;"><label for="inputDependencia"><b>Productos Alcanzados por el Trabajador</b></label><textarea class="form-control" rows="5" style="resize: none" id="productosalcanzados'+i+'" name="productosalcanzados'+i+'"></textarea></div></div></div></div>');

                                        $("#cantdias").val(this.dias);
                                        $('#actividad'+i).wysihtml5();
                                        $('#productosalcanzados'+i).wysihtml5();

                                }

                            }
                        }
                    }
                },
                createAnexo04: function(){

                        var url = 'ranexo04';
                        var data = new FormData($("#crearAnexo4")[0]);
                        
                        axios.post(url, data, {
                                onUploadProgress: (progressEvent) => {
                                    const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');
                                    if (totalLength !== null) {
                                        this.progressData = Math.round( (progressEvent.loaded * 100) / totalLength );
                                        $("#pro").css('width',this.progressData+'%');
                                        $("#pro").html(this.progressData+'%');
                                    }
                                }
                        }).then(response => {

                            this.cancelarActividades();
                            $("#pro").css('width','0%');
                            $("#pro").html('0%');

                            this.anexos4 = response.data.anexos4.data;
                            this.pagination = response.data.pagination;
                            if(this.anexos4.length==0 && this.thispage!='1'){
                                var a = parseInt(this.thispage) ;
                                a--;
                                this.thispage=a.toString();
                                this.changePage(this.thispage);
                            }

                            alertify.set({ delay: 4500 });
                            alertify.success("Anexo generado correctamente");

                        }).catch(error => {
                            this.errors = error.response.data;
                        })

                },
                editarActividades: function(anexs4){

                    var url = 'ranexo04/'+anexs4.id+'/edit';

                    axios.get(url).then(response => {

                       if (response.data.resultado==0) {
                            alertify.set({ delay: 3500 });
                            alertify.error("No se ha encontrado las actidades del Anexo Seleccionado");

                        }else{

                            this.cancelarActividadesEdit();

                            this.fillAnexo4.id = response.data.anexo4.id;
                            this.fillAnexo4.fec_ini = response.data.anexo4.fec_ini;
                            this.fillAnexo4.fec_fin = response.data.anexo4.fec_fin;
                            this.anexos4Actividades = response.data.actividad;


                            $("#cantdiasedit").val(response.data.totdias);

                            for (var i = 0; i < this.anexos4Actividades.length; i++) {

                                $("#cuerporActividadesEdit").append('<div class="col-md-12" style="padding-left: 0px;padding-right: 0px;"><div class="col-sm-12 box box-warning" style="box-shadow: 0px 1px 2px 0px #8d8686;background-color: #f3f3f3bf;margin-bottom: 15px;padding-bottom: 15px;border-top-color: #ff7701;"><div class="box-header with-border" style="padding-bottom: 0px;padding-top: 0px;"><div class="form-group" style="padding-top: 10px;"><label for="area" class="col-sm-6 control-label" style="margin-bottom: 0px;padding-top: 5px;text-align: left;padding-right: 0px;font-weight: bold;padding-left: 0px;"><span class="badge bg-orange" style="font-size: 15px;">Actividades realizadas el día '+this.anexos4Actividades[i]["fecha"]+'<input type="text" name="idactividad'+(i+1)+'" value="'+this.anexos4Actividades[i]["id"]+'" style="visibility: hidden;width: 9px;height: 7px;"></span></label><label for="area" class="col-sm-4 control-label" style="margin-bottom: 0px;padding-top: 5px;text-align: right;padding-right: 0px;font-weight: bold;">Tiempo laborado del día</label><div class="col-sm-2"><select class="form-control" style="padding-right: 10px;padding-left: 7px;" id="tiempo'+(i+1)+'" name="tiempo'+(i+1)+'"><option value="60">1 Hora</option><option value="120">2 Horas</option><option value="180">3 Horas</option><option value="240">4 Horas</option><option value="300">5 Horas</option><option value="360">6 Horas</option><option value="420">7 Horas</option><option value="480">8 Horas</option></select></div></div></div><div class="box-body" style="border: solid 1px #b3b3b3;margin-top: 10px;padding-bottom: 0px;"><div class="form-group has-feedback col-sm-12" style="padding-left: 0px;padding-right: 5px;"><label for="inputNombres"><b>Descripción de Actividades</b></label><textarea class="textarea form-control" style="resize: none" rows="6" id="actividad'+(i+1)+'" name="actividad'+(i+1)+'">'+this.anexos4Actividades[i]["actividad"]+'</textarea></div></div><div class="box-body" style="border: solid 1px #b3b3b3;margin-top: 10px;padding-bottom: 0px;"><div class="form-group has-feedback col-sm-12" style="padding-right: 0px;padding-left: 0px;"><label for="inputDependencia"><b>Productos Alcanzados por el Trabajador</b></label><textarea class="form-control" rows="5" style="resize: none" id="productosalcanzados'+(i+1)+'" name="productosalcanzados'+(i+1)+'">'+this.anexos4Actividades[i]["productosalcanzados"]+'</textarea></div></div></div></div>');

                                    $('#tiempo'+(i+1)+'> option[value="'+this.anexos4Actividades[i]["tiempo"]+'"]').attr('selected', 'selected');
                                    $('#actividad'+(i+1)).wysihtml5();
                                    $('#productosalcanzados'+(i+1)).wysihtml5();
                            }

                            $("#edit").modal("show");
                              
                        }
                     
                    });

                },
                updateAnexo4acti: function(idanexo4){
                    
                    var url = 'ranexo04/'+idanexo4;
                    var data = new FormData($("#updateAnexo4")[0]);

                    axios.post(url, data, {
                                onUploadProgress: (progressEvent) => {
                                    const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');
                                    if (totalLength !== null) {
                                        this.progressData = Math.round( (progressEvent.loaded * 100) / totalLength );
                                        $("#proEdit").css('width',this.progressData+'%');
                                        $("#proEdit").html(this.progressData+'%');
                                    }
                                }
                    }).then(response => {

                            $("#proEdit").css('width','0%');
                            $("#proEdit").html('0%');

                            this.cancelarActividadesEdit();

                            this.anexos4 = response.data.anexos4.data;
                            this.pagination = response.data.pagination;
                            if(this.anexos4.length==0 && this.thispage!='1'){
                                var a = parseInt(this.thispage) ;
                                a--;
                                this.thispage=a.toString();
                                this.changePage(this.thispage);
                            }

                            alertify.set({ delay: 4500 });
                            alertify.success("Anexo Modificado correctamente");
                     
                    }).catch(error => {
                            this.errors = error.response.data;
                    })

                },
                eliminarAnexo: function(anexs4){
                    
                    var url = 'ranexo04/' + anexs4.id;

                    swal({
                          title: "Atención!",
                          text: "Va a Eliminar el Anexo 04 generado. ¿Desea Continuar?",
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            
                            axios.delete(url).then(response => {  
                        
                                this.anexos4 = response.data.anexos4.data;
                                this.pagination = response.data.pagination;
                                if(this.anexos4.length==0 && this.thispage!='1'){
                                    var a = parseInt(this.thispage) ;
                                    a--;
                                    this.thispage=a.toString();
                                    this.changePage(this.thispage);
                                }

                                alertify.set({ delay: 2000 });
                                alertify.success("Anexo 04 eliminado correctamente"); //Mensaje
                               
                            });
                            
                        }
                    });

                },
                enviarAnexo: function(anexs4){

                    var url = 'ranexo04/'+anexs4.id+'/edit';

                    axios.get(url).then(response => {

                       if (response.data.resultado==0) {
                            alertify.set({ delay: 3500 });
                            alertify.error("No se ha encontrado el Anexo 04 Seleccionado");

                        }else{
                            
                            this.cancelarActividadesSend();

                            this.fillAnexo4.id = response.data.anexo4.id;
                            this.fillAnexo4.fec_ini = response.data.anexo4.fec_ini;
                            this.fillAnexo4.fec_fin = response.data.anexo4.fec_fin;
                            this.anexos4ActividadesSend = response.data.actividad;
                            $("#cuerporActividadesSend").append('<embed src="generarAnexo04/'+this.fillAnexo4.id+'" style="width: 100%" height="375">');
                            $("#previsualizaAnexo4").modal('show');
                        }
                     
                    });

                    

                },
                calcularDias: function(startDate,endDate){
                    var ndays;
                    ndays = (endDate - startDate) / 1000 / 86400;
                    ndays = (Math.round(ndays - 0.5)+1);
                    return ndays;
                },
                cancelarActividades: function(){

                      $("#cuerporActividades").empty();
                      this.newAnexo4.fec_ini='';
                      this.newAnexo4.fec_fin='';

                      $("#create").modal('hide');
                },
                cancelarActividadesEdit: function(){
                    $("#cuerporActividadesEdit").empty();
                    this.fillAnexo4.id = '';
                    this.fillAnexo4.fec_ini = '';
                    this.fillAnexo4.fec_fin = '';
                    this.anexos4Actividades = [];

                    $("#edit").modal('hide');
                },
                cancelarActividadesSend: function(){
                    $("#cuerporActividadesSend").empty();
                    this.fillAnexo4.id = '';
                    this.fillAnexo4.fec_ini = '';
                    this.fillAnexo4.fec_fin = '';
                    this.anexos4ActividadesSend = [];

                    $("#previsualizaAnexo4").modal('hide');
                },
                changePage: function(page){
                    this.pagination.current_page=page;
                    this.getArea(page);
                    this.thispage=page;
                }
                
            }
            
        });

</script>




<script type="text/javascript">
          // $(".select2").select2();

</script>

