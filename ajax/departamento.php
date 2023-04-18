<?php   
require_once "../modelos/Departamento.php";

$departamento=new Departamento();

switch ($_GET["op"]){
    case 'listar':
      $rspta=$departamento->listar();
      $data=Array();
      while ($reg=$rspta->fetch_object()){
        $data[]=array(
          "0"=>($reg->activo)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idDepartamento.')"><i class="fa fa-pencil"></i></button>'.
          ' <button class="btn btn-danger" onclick="desactivar('.$reg->idDepartamento.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idDepartamento.')"><i class="fa fa-pencil"></i></button>'.
          ' <button class="btn btn-primary" onclick="activar('.$reg->idDepartamento.')"><i class="fa fa-check"></i></button>',
          "1"=>$reg->descripcion,
          "2"=>$reg->fechaCreacion,
          "3"=>$reg->fechaActualizacion,
          "4"=>($reg->activo)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
          "5"=>$reg->idEmpActualiza
        );
      }
      $results=array(
        "sEcho"=>1, //informacion para el datatables
        "iTotalRecords"=>count($data),
        "iTotalDisplayRecords"=>count($data),
        "aaData"=>$data);
      echo json_encode($results);
  
  /*
  
          echo "$reg->idDepartamento";
          echo "$reg->descripcion";
          echo "$reg->activo";
          echo "$reg->fechaCreacion";
          echo "$reg->fechaActualizacion";
          echo "$reg->idEmpActualiza";
          */
} 

?>