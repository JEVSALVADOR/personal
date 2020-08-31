@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	
	<div class="container-fluid spark-screen" id="contenidoItemFF">
		<div id="loadingmessage" style="display:none;width: 80px;">
		       <img src='img/loader.gif'/>
		</div>
	</div>

	<div class="container-fluid spark-screen" id="contenidoItem">
		
		
	@if(Auth::user()->tipo_user_id=="1" || Auth::user()->tipo_user_id=="3")

		<div class="row">

	        <div class="col-lg-3 col-xs-6">
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3>ANEXO 04</h3>
	              <p>Formato de Trabajo Remoto</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-clipboard"></i>
	            </div>
	            <a href="#" id="hanexo4" class="small-box-footer">
	              <b>Ver</b> <i class="fa fa-arrow-circle-right"></i>
	            </a>
	          </div>
	        </div>
	 
	        <div class="col-lg-3 col-xs-6">
	          <div class="small-box bg-green">
	            <div class="inner">
	              <h3>LISTA</h3>
	              <p>de Anexos 04 Generados</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-list-ul"></i>
	            </div>
	            <a href="#" id="hlistaanexo4" class="small-box-footer">
	              <b>Ver</b>  <i class="fa fa-arrow-circle-right"></i>
	            </a>
	          </div>
	        </div>
	       
	    </div>

	@endif

		
	</div>
@endsection
