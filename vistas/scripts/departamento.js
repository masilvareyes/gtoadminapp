var table;

function init(){
	listar();
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

init();