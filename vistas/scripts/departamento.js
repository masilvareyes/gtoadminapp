var table;

function init(){
	listar();
	mostrarform(false);//ocultamos formulario al cargar la pagina.
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
		"iDisplayLength":3, //indica cuantos registros vamos a mostrar en el table.
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

init();