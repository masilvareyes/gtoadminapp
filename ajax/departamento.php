<?php   
require_once "../modelos/Departamento.php";

$departamento=new Departamento();

switch ($_GET["op"]){
    case 'listar':
      $rspta=$departamento->listar();
      $data=Array();
      while ($reg=$rspta->fetch_object()){
        $data[]=array(
          "0"=>($reg->activo)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idDepartamento.')"><i class="far fa-edit"></i></button>'.
          ' <button class="btn btn-danger" onclick="desactivar('.$reg->idDepartamento.')"><i class="far fa-window-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idDepartamento.')"><i class="fa fa-edit"></i></button>'.
          ' <button class="btn btn-primary" onclick="activar('.$reg->idDepartamento.')"><i class="far fa-check-square"></i></button>',
          "1"=>$reg->descripcion,
          "2"=>$reg->fechaCreacion,
          "3"=>$reg->fechaActualizacion,
          "4"=>($reg->activo)?'<span class="badge badge-success">Activado</span>':'<span class="badge badge-danger">Desactivado</span>',
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