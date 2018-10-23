<?php
?>
<script src="<?php echo base_url() ?>assets/jquery/dist/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>assets/jquery/dist/datepicker-es.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<h1>Programas y trámites</h1>
<h4>Modelo de emprendimiento de alto impacto</h4>
<br>
<br>
<br>
<h5>Programa del curso de la academia</h5>
<?php echo validation_errors();
?>
<form action="javascript:;" method="post" id="formD">
	<div id="temas">
		<?php
		for($i = 0; $i<20; $i++){
		?>
			<input type="text" name="tema<?php echo($i+1)?>" placeholder="Tema <?php echo($i+1)?> (max 40 caracteres)" maxlength="40" class="tema">
		<?php		
		}
		?>
	</div>
	<div id="infoMaestros">
		<?php
		for($i = 0; $i<3; $i++){
		?>
			<div id="maestro<?php echo($i+1)?>">
				<h6>Información del maestro <?php echo($i+1)?> - Curso de la academia</h6>
				<img src="" alt="">
				<button class="cambiarImg">Cambiar imágen</button>
				<input type="file" class="fileMaestro" name="imgMaestro<?php echo($i+1)?>" accept="image/jpeg,image/gif,image/png">
				<label>
					Nombre del maestro
					<input type="text" name="nombre_maestro<?php echo($i+1)?>" placeholder="Max 30 caracteres">
				</label>
				<label>
					Nombre de la licenciatura
					<input type="text" name="licenciatura_maestro<?php echo($i+1)?>" placeholder="Max 40 caracteres">
				</label>
			</div>
		<?php		
		}
		?>
	</div>
	<div id="pdf" class="divColumn">
		<h6>PDF descargable para Modelo de Emprendimiento Social</h6>
		<span id="existePDF"></span>
		<button id="cambiarPDF">Cambiar PDF</button>
		<span id="nuevoPDF"></span>
		<input type="file" name="pdf" accept="application/pdf">
	</div>
	<div id="correo" class="divColumn">
		<h6>Correo electrónico que se muestra en la sección de trámite, para que los usuarios envíen sus documentos</h6>
		<input type="text" name="correo" placeholder="Max 40 caracteres">
	</div>
	<div id="fechaInicio" class="divColumn">
		<h6>Fecha de inicio del próximo curso de la academia</h6>
		<input type="text" name="fechaInicio" class="dateP">
	</div>
	<div id="fechaEntrega" class="divColumn">
		<h6>Próxima fecha de entrega de dictámenes de financiamiento</h6>
		<input type="text" name="fechaEntrega" class="dateP">
	</div>
	<div id="botones">
		<button id="regreasr">Regresar</button>
		<button type="submit" id="guardar">Guardar cambios</button>
	</div>
</form>

<style>
	.tema,#infoMaestros div label,.fileMaestro, .divColumn input{
		display: block;
	    width: 50%;
	    margin: 10px 0px;
	    font-size: 14px;
	}
	#infoMaestros div, .divColumn{
		display: flex;
    	justify-content: center;
    	flex-flow: column;
    	margin:20px 0px;
    	align-items: flex-start;
	}
	#infoMaestros div label{
		display: flex;
	    flex-flow: column;
	    justify-content: center;
	    width: 50%;
	}
	#infoMaestros div img{
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
		$(".dateP").datepicker();
		$(".dateP").datepicker("option", "dateFormat","yy-mm-dd");
		$("#regresar").on("click",function(e){
			e.preventDefault();
		});
		$("#guardar").on("click",function(e){
			e.preventDefault();
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
			$.ajax({
				//prod:
				url:"<?php echo base_url()?>index.php/programas_y_tramites/EmprendimientoAltoImpacto/validarForm",
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
								$("input[name="+data.faltantes[i]+"]").css("border","2px solid red");
							}
						}
					}else{
						if(data.code == 200){
							if(!yaHayDatos){
								alert("Los datos se han guardado");
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
			
		});
		var yaHayDatos = false;
		function getDatos(){
			$.ajax({
				//prod:
				url:"<?php echo base_url()?>index.php/programas_y_tramites/EmprendimientoAltoImpacto/cargarDatos",
				/*//dev
				url:"<?php //echo base_url()?>programas_y_tramites/EmprendimientoAltoImpacto/cargarDatos",*/
				type:"post",
				beforeSend:function(){
					$("#loader").show();
				},
				success:function(data){
					console.log(data);
					yaHayDatos = (data.cursos.length > 0 && data.maestros.length > 0 && data.empre.length > 0);
					console.log(yaHayDatos);
					if(data.cursos.length>0){
						for(var i = 0; i<20; i++){
							$("input[name=tema"+(data.cursos[i].id)+"]").val(data.cursos[i].curso);
						}
					}
					if(data.maestros.length > 0){
						for(var i = 0; i<3; i++){
							$("input[name=nombre_maestro"+(data.maestros[i].id)+"]").val(data.maestros[i].nombre);
							$("input[name=licenciatura_maestro"+(data.maestros[i].id)+"]").val(data.maestros[i].licenciatura);
							$("#maestro"+data.maestros[i].id+" img").attr("src",url_imagenes+data.maestros[i].imagen);
							$("#maestro"+data.maestros[i].id+" .fileMaestro").hide();
							$("#maestro"+data.maestros[i].id+" .cambiarImg").show();
						}
					}
					if(data.empre.length > 0){
						$("#existePDF").text(data.empre[0].pdf);
						$("#cambiarPDF").show();
						$("input[name=pdf]").hide();
						$("input[name=correo]").val(data.empre[0].correo);
						$("input[name=fechaInicio]").val(data.empre[0].fechaInicio);
						$("input[name=fechaEntrega]").val(data.empre[0].fechaEntrega);
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