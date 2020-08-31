$(function(){

	$("#sanexo4").on("click", function(event){

		$('#contenidoItem').hide();
		$('#contenidoItemFF').removeAttr("style");
		$('#contenidoItemFF').attr("style", "padding-left: 39%;padding-right: 0px;padding-top: 15%;");
		$('#loadingmessage').show();
		event.preventDefault();
		$.get("ranexo04/show",function(response){
			$('#contenidoItem').html(response.view);
			$('#contenidoItem').fadeIn("slow");
			$('#loadingmessage').hide();
			$('#contenidoItemFF').hide();
		});
	});

	$("#hanexo4").on("click", function(event){

		$('#contenidoItem').hide();
		$('#contenidoItemFF').removeAttr("style");
		$('#contenidoItemFF').attr("style", "padding-left: 39%;padding-right: 0px;padding-top: 15%;");
		$('#loadingmessage').show();
		event.preventDefault();
		$.get("ranexo04/show",function(response){
			$('#contenidoItem').html(response.view);
			$('#contenidoItem').fadeIn("slow");
			$('#loadingmessage').hide();
			$('#contenidoItemFF').hide();
		});
	});

});





