var table;

function init(){
	mostrarform(false);

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

init();