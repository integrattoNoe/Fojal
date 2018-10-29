<h1>Calendario</h1>
<h4 id="subtitulo">Eventos</h4>

<div id="botones">
	<div id="eventosBtn">
		<button class="btnActivo" id="actuales">Eventos actuales</button>
		<button id="pasados">Eventos pasados</button>
	</div>
	<div id="nuevoEvento">
		<button id="nuevoEventoBtn">Publicar nuevo evento</button>
	</div>
</div>
<div id="eventos">
	
	<h3>Lista de eventos</h3>
	<table>
		<thead>
			<tr>
				<th>ID Evento</th>
				<th>Título del evento</th>
				<th>Fecha del evento</th>
				<th>Fecha de publicación</th>
				<th>Publicado por</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>

<div id="crudEvento">
	<form action="javascript:;" id="formCrudEvento">
		<div id="titulo" class="divColumn">
			<h6>Título del evento</h6>
			<input type="text" name="titulo" placeholder="Escribir título del evento (Max 50 caracteres)" maxlength="50">
		</div>
		<div id="fecha" class="divColumn">
			<h6>Seleccionar fecha</h6>
			<input type="text" name="fecha" class="dateP" placeholder="Seleccionar fecha">
		</div>
	</form>
	<div id="botonesCrud">
		<button id="regresar">Regresar</button>
		<button id="eliminar">Eliminar evento</button>
		<button type="submit" id="guardar">Guardar cambios</button>
	</div>
</div>

<div id="detalleEvento">
	
</div>

<script>
	$(document).ready(function(){
		getDatos();
		$(".dateP").datepicker();
		$(".dateP").datepicker("option", "dateFormat","yy-mm-dd");

		var accion = "guardar";
		var mostrar = "actuales";
		var idEventoSel;

		$("#nuevoEventoBtn").on("click",function(){
			accion = "guardar";
			mostrarCrudEvento();
		});
		$("#regresar").on("click",function(){
			console.log("click");
			mostrarEventos();
		});
		$("#guardar").on("click",function(){
			guardar();
		});
		$("#actuales").on("click",function(){
			$(".btnActivo").removeClass("btnActivo");
			$(this).addClass("btnActivo");
			$(".pasado").hide();
			$(".actual").show();
		});
		$("#pasados").on("click",function(){
			$(".btnActivo").removeClass("btnActivo");
			$(this).addClass("btnActivo");
			$(".actual").hide();
			$(".pasado").show();
		});
		$("#eliminar").on("click",function(){
			eliminar();
		});

		$(document).on("click",".detalles",function(){
			idEventoSel = $(this).closest("tr").find(".idEvento").text();
			console.log(idEventoSel);
			var titulo = $(this).closest("tr").find(".tituloEvento").text();
			var fecha = $(this).closest("tr").find(".fechaEvento").text();
			$("input[name=titulo]").val(titulo);
			$("input[name=fecha]").val(fecha);
			accion = "editar";
			mostrarCrudEvento();
			if($(this).closest("tr").hasClass("pasado")){
				$("input[name=titulo],input[name=fecha]").prop("disabled",true);
				idEventoSel = "";
				accion = "";
				$("#eliminar,#guardar").hide();
				$("#subtitulo").text("Evento pasado");
			}
		});

		function mostrarCrudEvento(){
			$("#eliminar,#guardar").show();
			if(accion=="guardar")
				$("#eliminar").hide();
			$("#eventos,#detalleEvento,#botones").hide();
			$("#crudEvento").show();
			$("#subtitulo").text("Editar evento");
			$("input[name=titulo],input[name=fecha]").css("border","1px solid gray");
			$("input[name=titulo],input[name=fecha]").prop("disabled",false);
			if(accion == "guardar"){
				$("input[name=titulo],input[name=fecha]").val("");
				$("#subtitulo").text("Publicar nuevo evento");
			}
		}

		function mostrarEventos(){
			$("#crudEvento,#detalleEvento,#eliminar").hide();
			$("#botones,#eventos").show();
			$("#subtitulo").text("Eventos");
		}

		function guardar(){
			$("input[name=titulo],input[name=fecha]").css("border","1px solid gray");	
			if($("input[name=titulo]").val() == ""){
				alert("Debes ingresar un título");
				$("input[name=titulo]").css("border","2px solid red");
			}else if($("input[name=fecha]").val() == ""){
				alert("Debes seleccionar la fecha");
				$("input[name=fecha]").css("border","2px solid red");
			}else{
				var formD = new FormData(document.getElementById("formCrudEvento"));
				formD.append("accion",accion);
				if(accion == "editar"){
					formD.append("idEvento",idEventoSel);
				}
				$.ajax({
					//prod:
					url:"<?php echo base_url()?>index.php/calendario/Calendario/guardar",
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
							alert("Error al crear el evento");
						}else{
							if(data.code == 200){
								if(accion == "guardar"){
									alert("Se a creado el evento");
								}else{
									alert("El evento se a actualizado");
								}
								getDatos();
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

		function getDatos(){
			$("#eventos table tbody").html("");
			$.ajax({
				//prod:
				url:"<?php echo base_url()?>index.php/calendario/Calendario/getEventos",
				/*//dev
				url:"<?php //echo base_url()?>programas_y_tramites/EmprendimientoAltoImpacto/validarForm",*/
				type:"post",
				cache: false,
				contentType: false,
				processData: false,
				beforeSend:function(){
					$("#loader").show();
				},
				success:function(data){
					console.log(data);
					let total = data.eventos.length;
					let hoy = new Date(data.hoy);
					for(let i = 0; i<total; i++){
						let fechaEvento = new Date(data.eventos[i].fechaEvento);
						let tr;
						if(fechaEvento < hoy){
							tr = "<tr class='pasado'>";
						}else{
							tr = "<tr class='actual'>";
						}
						tr += "<td class='idEvento'>"+data.eventos[i].idEvento+"</td>";
						tr += "<td class='tituloEvento'>"+data.eventos[i].titulo+"</td>";
						tr += "<td class='fechaEvento'>"+data.eventos[i].fechaEvento+"</td>";
						tr += "<td class='fechaEventoPublicado'>"+data.eventos[i].fechaPublicado+"</td>";
						tr += "<td class='autorEvento'>"+data.eventos[i].nombre+"</td>";
						tr += "<td><span class='detalles'>Detalles</span></td>";
						tr += "</tr>";
						$("#eventos table tbody").append(tr);
						if(mostrar == "actuales"){
							$(".pasado").hide();
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

		function eliminar(){
			if(idEventoSel != ""){
				let resp = confirm("Deseas eliminar este evento");
				if(resp){
					$.ajax({
						//prod:
						url:"<?php echo base_url()?>index.php/calendario/Calendario/eliminar",
						/*//dev
						url:"<?php //echo base_url()?>programas_y_tramites/EmprendimientoAltoImpacto/validarForm",*/
						type:"post",
						data:{"idEliminar":idEventoSel},
						beforeSend:function(){
							$("#loader").show();
						},
						success:function(data){
							console.log(data);
							if(data.code == 400){
								alert("Error al eliminar el evento");
							}else{
								if(data.code == 200){
									alert("El evento se a aliminado");
									getDatos();
									mostrarEventos();
									idEventoSel = "";
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
		}
	});
	
</script>
<style>
	#detalleEvento,#crudEvento{
		display: none;
	}
	#eventos table{
		width: 80%;
	}
	#eventos table th{
		text-align: center;
	}
	#eventos table th:nth-child(1),th:nth-child(6){
		width: 10%;
	}
	#eventos table th:nth-child(2){
		width: 30%;
	}
	#eventos table th:nth-child(3),th:nth-child(4){/*30px*/
		width: 15%;
	}
	#eventos table th:nth-child(5){
		width: 20%;
	}
	.divColumn input{
		display: block;
	    width: 50%;
	    margin: 10px 0px;
	    font-size: 14px;
	}
	.btnActivo{
		background: #00CCCC;
		color:#fff;
	}
	button{
		background: #fff;
		border: 1px solid lightgray;
		padding: 10px;
		color: #000;
	}
	#eventos td{
		text-align: center;
	}
	#eventos th{
		background-color: #d6f5f5;

	}
	#eventos tr, #eventos td, #eventos th{
		border:1px solid lightgray;
	}
	.detalles{
		color: #0099CC;
		cursor: pointer;
	}
</style>