<h1>Calendario</h1>
<h4 id="subtitulo">Banners en la sección de Calendario</h4>
<form action="javascript:;" id="formBanners">
	<div id="financiamiento" class="divColumn">
		<h6>Banner de "Programas de financiamiento" - Próximos periodo de convocatoria</h6>
		<input type="text" name="diaInicio" class="dateP" placeholder="Día de inicio">
		<input type="text" name="diaFinal" class="dateP" placeholder="Día final">
	</div>
	<div id="platicas" class="divColumn">
		<h6>Banner de "Platicas informativas" - Horario</h6>
		<select name="inicioplaticas" id="inicioplaticas">
			<option value="0">Hora de inicio</option>
			<option value="08:00:00">08:00</option>
			<option value="09:00:00">09:00</option>
			<option value="10:00:00">10:00</option>
			<option value="11:00:00">11:00</option>
			<option value="12:00:00">12:00</option>
		</select>
		<select name="finplaticas" id="finplaticas">
			<option value="0">Hora que finaliza</option>
			<option value="08:00:00">08:00</option>
			<option value="09:00:00">09:00</option>
			<option value="10:00:00">10:00</option>
			<option value="11:00:00">11:00</option>
			<option value="12:00:00">12:00</option>
		</select>
	</div>
	<div id="citas" class="divColumn">
		<h6>Banner de "Citas de asesoría" - Horario</h6>
		<div>
			<select name="inicioCitas1" id="inicioCitas1">
				<option value="0">Hora de inicio</option>
				<option value="08:00:00">08:00</option>
				<option value="09:00:00">09:00</option>
				<option value="10:00:00">10:00</option>
				<option value="11:00:00">11:00</option>
				<option value="12:00:00">12:00</option>
			</select>
			<select name="finCitas1" id="finCitas1">
				<option value="0">Hora que finaliza</option>
				<option value="08:00:00">08:00</option>
				<option value="09:00:00">09:00</option>
				<option value="10:00:00">10:00</option>
				<option value="11:00:00">11:00</option>
				<option value="12:00:00">12:00</option>
			</select>
		</div>
		<div>
			<select name="inicioCitas2" id="inicioCitas2">
				<option value="0">Hora de inicio</option>
				<option value="08:00:00">08:00</option>
				<option value="09:00:00">09:00</option>
				<option value="10:00:00">10:00</option>
				<option value="11:00:00">11:00</option>
				<option value="12:00:00">12:00</option>
			</select>
			<select name="finCitas2" id="finCitas2">
				<option value="0">Hora que finaliza</option>
				<option value="08:00:00">08:00</option>
				<option value="09:00:00">09:00</option>
				<option value="10:00:00">10:00</option>
				<option value="11:00:00">11:00</option>
				<option value="12:00:00">12:00</option>
			</select>
		</div>
	</div>
	<div id="botonesCrud">
		<button id="regresar">Regresar</button>
		<button type="submit" id="guardar">Guardar cambios</button>
	</div>
</form>

<script>
	$(document).ready(function(){
		var accion = "guardar";
		var yaHayDatos = false;

		$(".dateP").datepicker();

		$(".dateP").datepicker("option", "dateFormat","yy-mm-dd");

		$("#guardar").on("click",function(){
			guardar();
		});

		$("#regresar").on("click",function(){

		});

		getBanners();

		function getBanners(){
			$.ajax({
				//prod:
				url:"<?php echo base_url()?>index.php/calendario/Banners/getBanners",
				/*//dev
				url:"<?php //echo base_url()?>programas_y_tramites/EmprendimientoAltoImpacto/validarForm",*/
				type:"get",
				beforeSend:function(){
					$("#loader").show();
				},
				success:function(data){
					if(data.length > 0){
						$("input[name=diaInicio]").val(data[0].diaInicio);
						$("input[name=diaFinal]").val(data[0].diaFinal);
						$("#inicioplaticas option[value='"+data[0].inicioplaticas+"']").prop("selected",true);
						$("#finplaticas option[value='"+data[0].finplaticas+"']").prop("selected",true);
						$("#inicioCitas1 option[value='"+data[0].inicioCitas1+"']").prop("selected",true);
						$("#inicioCitas2 option[value='"+data[0].inicioCitas2+"']").prop("selected",true);
						$("#finCitas1 option[value='"+data[0].finCitas1+"']").prop("selected",true);
						$("#finCitas2 option[value='"+data[0].finCitas2+"']").prop("selected",true);
						yaHayDatos = true;
					}
					
				},
				complete:function(){
					$("#loader").fadeOut();
				},
				error: function(x,e){
					if (x.status==0) {
				        alert('Estás desconectado o se interrumpió la conexión!!\n Por favor verifica tu conexión a Internet.');
				    } else if(x.status==404) {
				        alert('URL no encontrada.');
				    } else if(x.status==500) {
				        alert('Error interno del servidor.');
				        console.log(x);
				    } else if(e=='parsererror') {
				        alert('Error.\nRespuesta incorrecta (JSON).');
				    } else if(e=='timeout'){
				        alert('Se sobrepaso el tiempo de conexión.');
				    } else {
				        alert('Error indefinido.\n'+x.responseText);
				    }
				}
			});
		}
		
		function guardar(){
			var valido = true;
			if(yaHayDatos)
				accion = "actualizar";

			$("form input, form select").css("border","1px solid gray");
			$("#formBanners input").each(function(){
				if($(this).val() == ""){
					$(this).css("border","2px solid red");
					valido = false;
				}
			});
			$("#formBanners select option:selected").each(function(){
				if($(this).val() == "0"){
					$(this).closest("select").css("border","2px solid red");
					valido = false;
				}
			});

			if(!valido){
				alert("Debes llenar todos los campos");
			}else{
				var formD = new FormData(document.getElementById("formBanners"));
				formD.append("accion",accion);
				console.log(formD);
				$.ajax({
					//prod:
					url:"<?php echo base_url()?>index.php/calendario/Banners/guardar",
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
						console.log(data);
						if(data.code == 400){
							alert("Error al guardar los banners");
						}else{
							if(data.code == 200){
								if(accion == "guardar"){
									alert("Se han creado los banners");
									yaHayDatos = true;
								}else{
									alert("Los banners se han actualizado");
								}
							}else{
								alert(data.msg);
							}
						}
					},
					complete:function(){
						$("#loader").fadeOut();
					},
					error: function(x,e){
						if (x.status==0) {
					        alert('Estás desconectado o se interrumpió la conexión!!\n Por favor verifica tu conexión a Internet.');
					    } else if(x.status==404) {
					        alert('URL no encontrada.');
					    } else if(x.status==500) {
					        alert('Error interno del servidor.');
					        console.log(x);
					    } else if(e=='parsererror') {
					        alert('Error.\nRespuesta incorrecta (JSON).');
					    } else if(e=='timeout'){
					        alert('Se sobrepaso el tiempo de conexión.');
					    } else {
					        alert('Error indefinido.\n'+x.responseText);
					    }
					}
				});
			}
		}
	});
	


</script>