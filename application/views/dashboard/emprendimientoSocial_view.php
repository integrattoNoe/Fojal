<?
?>
<script src="<?= base_url() ?>assets/jquery/dist/jquery-ui.js"></script>
<script src="<?= base_url() ?>assets/jquery/dist/datepicker-es.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery-ui.css">
<h1>Programas y trámites</h1>
<h4>Modelo de emprendimiento social</h4>
<br>
<br>
<br>
<h5>Programa del curso de la academia</h5>
<?echo validation_errors();?>
<form action="javascript:;" method="post" id="formD">
	<div id="temas">
		<?
		for($i = 0; $i<20; $i++){
		?>
			<input type="text" name="tema<?=($i+1)?>" placeholder="Tema <?=($i+1)?> (max 40 caracteres)" maxlength="40" class="tema">
		<?		
		}
		?>
	</div>
	<div id="infoMaestros">
		<?
		for($i = 0; $i<3; $i++){
		?>
			<div id="maestro<?=($i+1)?>">
				<h6>Información del maestro <?=($i+1)?> - Curso de la academia</h6>
				<img src="" alt="">
				<input type="file" class="fileMaestro" name="imgMaestro<?=($i+1)?>">
				<label>
					Nombre del maestro
					<input type="text" name="nombre_maestro<?=($i+1)?>" placeholder="Max 30 caracteres">
				</label>
				<label>
					Nombre de la licenciatura
					<input type="text" name="licenciatura_maestro<?=($i+1)?>" placeholder="Max 40 caracteres">
				</label>
			</div>
		<?		
		}
		?>
	</div>
	<div id="pdf" class="divColumn">
		<h6>PDF descargable para Modelo de Emprendimiento Social</h6>
		<input type="file" name="pdf">
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
</style>
<script>
	$(document).ready(function(){
		$(".dateP").datepicker();
		$(".dateP").datepicker("option", "dateFormat","yy-mm-dd");
		$("#regresar").on("click",function(e){
			e.preventDefault();
		});
		$("#guardar").on("click",function(e){
			e.preventDefault();
			var formD = new FormData(document.getElementById("formD"));
			$("input").each(function(){
				$(this).css("border","1px solid gray");	
			})
			$.ajax({
				url:"<?= base_url()?>emprendimientoSocial/validarForm",
				type:"post",
				data:formD,
				cache: false,
				contentType: false,
				processData: false,
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
					}
				},
				error:function(){

				}
			});
		});
	});
</script>