<?php
?>
<script src="<?php echo base_url() ?>assets/jquery/dist/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>assets/jquery/dist/datepicker-es.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<h1>Platicas informativas</h1>
<br>
<br>
<br>
<?php echo validation_errors();
?>
<form action="javascript:;" method="post" id="formD">
	<div id="ayudaFojal" class="divColumn">
		<h6>Conoce cómo podemos ayudarte en Fojal</h6>
		<textarea name="ayuda" id="ayudaArea" cols="30" rows="10" maxlength="700" placeholder="Max 700 carácteres"></textarea>
	</div>
	<div id="infoGeneral" class="divColumn">
		<h6>Información general</h6>
		<textarea name="infoGeneral" id="infoGeneralArea" cols="30" rows="10" maxlength="200" placeholder="Max 200 carácteres"></textarea>
	</div>
	<div id="confirma" class="divColumn">
		<h6>Confirma tu asistencia</h6>
		<textarea name="asistencia" id="asistenciaArea" cols="30" rows="10" maxlength="200" placeholder="Max 200 carácteres"></textarea>
	</div>
	<div id="horario" class="divColumn">
		<h6>Horario de platicas informativas</h6>
		<textarea name="horario" id="horarioArea" cols="30" rows="10" maxlength="100" placeholder="Max 100 carácteres"></textarea>
	</div>
	<div id="fotoGeneral" class="divColumn">
		<h6>Foto de lado de información general - Adjuntar imagen</h6>
		<img src="" alt="">
		<button class="cambiarImg">Cambiar imágen</button>
		<input type="file" class="fileMaestro" name="fotoGeneral" accept="image/jpeg,image/gif,image/png">
		<label>
	</div>
	<div id="botones">
		<button id="regreasr">Regresar</button>
		<button type="submit" id="guardar">Guardar cambios</button>
	</div>
</form>

<style>
	.tema,#fotoGeneral div label,.fileMaestro, .divColumn input, .divColumn textarea{
		display: block;
	    width: 50%;
	    margin: 10px 0px;
	    font-size: 14px;
	}
	#fotoGeneral div, .divColumn{
		display: flex;
    	justify-content: center;
    	flex-flow: column;
    	margin:20px 0px;
    	align-items: flex-start;
	}
	#fotoGeneral div label{
		display: flex;
	    flex-flow: column;
	    justify-content: center;
	    width: 50%;
	}
	#fotoGeneral img{
		width: 200px;
		height: 150px;
		border:1px solid #000;
	}
	h5,h6,h1,h2,h3,h4{
		color:#00CCCC;
	}
	button{
		width: auto;
		max-width: 300px;
	}
</style>
<script>
	$(document).ready(function(){
		$(".cambiarImg,#cambiarPDF,#nuevoPDF").hide();
		getDatos();
		/*$(".dateP").datepicker();
		$(".dateP").datepicker("option", "dateFormat","yy-mm-dd");*/
		$("#regresar").on("click",function(e){
			e.preventDefault();
		});
		$("#guardar").on("click",function(e){
			e.preventDefault();
			guardar();
			
		});
		var yaHayDatos = false;

		function getDatos(){
			$.ajax({
				//prod:
				url:"<?php echo base_url()?>index.php/platicas_informativas/PlaticasInformativas/cargarDatos",
				/*//dev
				url:"<?php //echo base_url()?>programas_y_tramites/EmprendimientoAltoImpacto/cargarDatos",*/
				type:"post",
				beforeSend:function(){
					$("#loader").show();
				},
				success:function(data){
					console.log(data);
					yaHayDatos = (data.platicas.length > 0 );
					console.log(yaHayDatos);
					$("#ayudaArea").text(data.platicas[0].ayuda);
					$("#infoGeneralArea").text(data.platicas[0].infoGeneral);
					$("#asistenciaArea").text(data.platicas[0].asistencia);
					$("#horarioArea").text(data.platicas[0].horario);
					$("#fotoGeneral img").attr("src",url_imagenes+data.platicas[0].foto);
					$(".fileMaestro").hide();
					$(".cambiarImg").show();

				},
				complete:function(){
					$("#loader").fadeOut();
				},
				error:function(){

				}
			});
		}

		function guardar(){
			var formD = new FormData(document.getElementById("formD"));
			if(yaHayDatos){
				//hay que actualizar
				formD.append("accion","actualizar");
			}else{
				//hay que guardar
				formD.append("accion","guardar");
			}
			$("input").each(function(){
				$(this).css("border","1px solid gray");	
			});
			$("textarea").each(function(){
				$(this).css("border","1px solid gray");	
			});
			$.ajax({
				//prod:
				url:"<?php echo base_url()?>index.php/platicas_informativas/PlaticasInformativas/validarForm",
				/*//dev
				url:"<?php //echo base_url()?>programas_y_tramites/EmprendimientoAltoImpacto/validarForm",*/
				type:"post",
				data:formD,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend:function(){
					$("#loader").show();
				},
				success:function(data){
					$(this).css("border","1px solid gray;");
					console.log(data);
					if(data.code == 400){
						alert("Revise que todos los campos estén llenos");
						if(data.faltantes.length >0){
							for(var i = 0; i<data.faltantes.length; i++){
								$("textarea[name="+data.faltantes[i]+"], input[name="+data.faltantes[i]+"]").css("border","2px solid red");
							}
						}
					}else{
						if(data.code == 200){
							if(!yaHayDatos){
								alert("Los datos se han guardado");
								yaHayDatos = true;
							}else{
								alert("Los datos se han actualizado");
							}

						}else{
							alert(data.msg);
						}
					}
				},
				complete:function(){
					$("#loader").fadeOut();
				},
				error:function(){

				}
			});
		}

		$(".cambiarImg").on("click",function(){
			$(this).closest("div").find(".fileMaestro").click();
		});

		$(".fileMaestro").on("change",function(){
			if($(this)[0].files[0]){
				var file = $(this)[0].files[0];
				console.log("Nombre: "+file.name);

				readURL(this,$(this).closest("div").find("img"));
				//$("#userPic > span").text(file.name);
			}
		});

		$("#cambiarPDF").on("click",function(){
			$("input[name=pdf]").click();
		});
		$("input[name=pdf]").on("change",function(){
			if(yaHayDatos){
				if($("input[name=pdf]")[0].files[0]){
					var file = $("input[name=pdf]")[0].files[0];
					$("#nuevoPDF").text("Nuevo PDF: "+file.name).show();
				}
			}
		});

		function readURL(input,imgTag) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $(imgTag).attr('src', e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
	});
</script>