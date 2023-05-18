var table;

function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e){
			guardaryeditar(e);
		}
	);

    //llamado al ajax de departamento para traer los options del select de departamentos
	$.post("../ajax/departamento.php?op=select",function(r){
		console.log(r);
		$("#idDepartamento").html(r);
		$("#idDepartamento").selectpicker("refresh");
	});

}

//limpiar formulario
function limpiar() {
	$("#idEmpleado").val("");
	$("#nombre").val("");
	$("#primerApellido").val("");
	$("#segundoApellido").val("");
	$("#email").val("");
	$("#fechaEntrada").val("");
	$("#fechaBaja").val("");
	$("#idDepartamento").val("");
	$("#idDepartamento").selectpicker("refresh");
	$("#idJefe").val("");
	$("#idJefe").selectpicker("refresh");
	$("#esJefe").prop("checked", false);
	$("#usr").val("");
	$("#pwd").val("");
	$("#foto").val("");
	$("#fotoActual").val("");
	$("#imagenmuestra").attr("src","");
}

function mostrarform(flag) {
	
	limpiar();
	if(flag){
		$("#listadoregdata").hide();
		$("#formregdata").show();
		$("#btnagregar").hide();
		$("#btnGuardar").prop("disable",false);
	}else{
		
		$("#formregdata").hide();
		$("#listadoregdata").show();
		$("#btnagregar").show();
	}
}

function cancelarform() {
	limpiar();
	mostrarform(false);
}


function guardaryeditar(e) {
	e.preventDefault();

	$("#btnagregar").prop("disable",true);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url:"../ajax/empleado.php?op=guardaryeditar",
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
			//table.ajax.reload();
		}
	});
	limpiar();
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
			url:'../ajax/empleado.php?op=listar',
			type:"get",
			dataType: "json",
			error:function(e) {
				console.log(e.responseText);
			}
		},
		"destroy": true,
		"iDisplayLength":5, //indica cuantos registros vamos a mostrar en el table.
		"order": [[1,"desc"]]
	}).DataTable();
}
init();