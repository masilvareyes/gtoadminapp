var table;

function init(){
	listar();
	mostrarform(false);//ocultamos formulario al cargar la pagina.
	//Agregamos evento a el formulario para guardar y editar
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
		}
	);
}

function listar(){
	table=$('#tblistadoregdata').dataTable({
		"Processing": true, //activar procesamiento de tablas
		"ServerSide": true, //paginacion y filtros sean realizados por el servidor
		responsive: true, //Active capacidades responsivas en la tabla
		dom: '<"top"Bfl>rt<"bottom"ip><"clear">', // definir los elementos de control de dataTables
												//B botones export, f filtro sencillo, l selector de filtas
												//r mensaje de procesamiento, t Table como tal, i informacion
												//p paginacion
		buttons:[
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
		],
		"ajax":{
			url:'../ajax/departamento.php?op=listar',
			type:"get",
			dataType: "json",
			error:function(e) {
				console.log(e.responseText);
			}
		}, 
		"destroy": true, //cada que se ejecute se reinicializa
		"iDisplayLength":5, //indica cuantos registros vamos a mostrar en el table.
		"order": [[1,"desc"]]
	}).DataTable();
}


//limpiar formulario
function limpiar() {
	$("#idDepartamento").val("");
	$("#descripcion").val("");
}

//función para mostrar u ocultar el formulario de alta/edición
function mostrarform(flag) {
	
	limpiar();  //limpiamos valores del formulario
	if(flag){
		//cuando flag es true, es decir queremos mostrar el formulario
		$("#listadoregdata").hide();  //escondemos el listado
		$("#formregdata").show();   //mostramos formulario
		$("#btnagregar").hide();   //escodemos boton agregar 
		$("#btnGuardar").prop("disable",false); //deshabilitamos el boton guardar
	}else{
		//cuando flag es false, es decir queremos ocultar el formulario
		$("#listadoregdata").show(); //Mostramos el listado
		$("#formregdata").hide(); //ocultamos el formulario
		$("#btnagregar").show(); //mostramos boton de agregar
	}
}

//función para limpiar y ocultar el formulario de alta/edición cuando damos clic en boton cancelar
function cancelarform() {
	limpiar();
	mostrarform(false);
}

//Creamos función de guardar y editar
function guardaryeditar(e) {
	e.preventDefault();
	//desactivamos eventos

	/*
	console.log($("#formulario"));
	console.log("separacion");
	console.log($("#formulario")[0]);
	*/
	//desactivamos botón guardar para evitar múltiples llamados 
	$("#btnagregar").prop("disable",true);
	//obtenemos datos del formulario y creamos pares 
	
	
	var formData = new FormData($("#formulario")[0]);
	//construimos nuestro Ajax tipo post y configuramos el llamado
	$.ajax({
		url:"../ajax/departamento.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false, //no manda cabecero
		processData: false, //no convierte objetos en string

		success: function (mensaje) {
			valida = mensaje.indexOf('rror');
			if(valida!=-1){
				toastr["error"](mensaje);
			}else{
				toastr["success"](mensaje);
			}
			mostrarform(false);
			table.ajax.reload();
		}
	});
	
	limpiar();
}

//se crea la función mostrar con parámetro idDepartamento
//esta función es la que recibe lo que manda el evento en el icono de editar
function mostrar(idDepartamento){
	// utilizamos el short hand de jQuery para Ajax post 
	// podemos crear nuestro propio arreglo de variables poniendo los pares entre {}
	// Función anónima para capturar el regreso
	$.post("../ajax/departamento.php?op=mostrar",{idDepartamento:idDepartamento},function(data){
		//console.log(data);
		//convertimos los datos que vienen de regreso en formato Json a tipo objeto 
		data=JSON.parse(data);
		//console.log(data);
		//Mostramos el formulario y ocultamos el listado 
		mostrarform(true); 
		//rellenamos a través de instrucciones jQuery los campos del formulario con los datos que nos regresó el Ajax
		$("#idDepartamento").val(data.idDepartamento);
		$("#descripcion").val(data.descripcion);

	});
}

//Creación de la función desactivar con el idDepartamento como parámetro
function desactivar(idDepartamento) {
	//Implementación de la ventana de verificación con toastr
	//Seleccionamos ventana de warning y mandamos a confirmar acción
	//Utilizando botones HTML para la respuesta
	var ventanaEleccion =toastr.warning('¿Deseas desactivar el depto seleccionado?<br>'+
		'<button type="button" id=rptaSi class="btn btn-success">Si</button>'+
		'<button type="button" id=rptaNo class="btn btn-danger">No</button>',"Alerta");

	//Añadimos funcionalidad para cada botón, capturando el evento clic y mandando una función anónima 
	//En caso de que decida continuar mandamos a llamar a nuestro Ajax de desactivamos
	$("#rptaSi").click(function() {
		console.log("El usuario ha elegido desactivar el depto");
		$.post("../ajax/departamento.php?op=desactivar",{idDepartamento:idDepartamento},function(mensaje){
			//alert(mensaje);
			//Preparamos el js para recibir el mensaje de resultado de la desactivación
			//Formateamos el mensaje de respuesta
			valida = mensaje.indexOf('rror');
			
			if(valida!=-1){
				toastr["error"](mensaje);
			}else{
				toastr["success"](mensaje);
			}
			table.ajax.reload();
		});
	});

	//En caso de que no decida continuar mandamos no realizamos ninguna acción 
	$("#rptaNo").click(function() {
		console.log("El usuario ha elegido cancelar la accion")
		toastr.clear(ventanaEleccion);
	});

}

//Reutilizamos el código para implementar la funcionalidad de activar.
function activar(idDepartamento) {
	var ventanaEleccion =toastr.warning('¿Deseas activar el depto seleccionado?<br>'+
		'<button type="button" id=rptaSi class="btn btn-success">Si</button>'+
		'<button type="button" id=rptaNo class="btn btn-danger">No</button>',"Alerta");

	$("#rptaSi").click(function() {
		console.log("El usuario ha elegido activar el depto");
		$.post("../ajax/departamento.php?op=activar",{idDepartamento:idDepartamento},function(mensaje){
			//alert(mensaje);
			valida = mensaje.indexOf('rror');
			
			if(valida!=-1){
				toastr["error"](mensaje);
			}else{
				toastr["success"](mensaje);
			}
			table.ajax.reload();
		});
	});

	$("#rptaNo").click(function() {
		console.log("El usuario ha elegido cancelar la accion")
		//Limpiamos mensajes que hayan quedado instanciados
		toastr.clear(ventanaEleccion);
	});

}
init();