<?php 

require_once "../modelos/Empleado.php";
$empleado=new Empleado();

$idCategoria=isset($_POST['idCategoria'])?limpiarCadenas($_POST['idCategoria']):"";
$descripcion=isset($_POST['descripcion'])?limpiarCadenas($_POST['descripcion']):"";

$fechaActualizacion=date("Y-m-d H:i:s");
$idEmpActualiza=1; // Cambiar por el usuario de la sesion.


switch ($_GET["op"]){
/*  case 'listar':
    $rspta=$categoria->listar();
    $data=Array();
    while ($reg=$rspta->fetch_object()){
      $data[]=array(
        "0"=>($reg->activo)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idCategoria.')"><i class="far fa-edit"></i></button>'.
        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idCategoria.')"><i class="far fa-window-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idCategoria.')"><i class="far fa-edit"></i></button>'.
        ' <button class="btn btn-primary" onclick="activar('.$reg->idCategoria.')"><i class="far fa-check-square"></i></button>',
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

  break;
  */
  case 'guardaryeditar':
    if(empty($idCategoria)){  //Nuevos Registros
      $rspta=$categoria->insertar($descripcion);
      echo $rspta!=0?"Categoria registrada":"Error categoria no resgistrada";
    }else{  //Registros ya existentes
      $rspta=$categoria->editar($idCategoria, $descripcion, $fechaActualizacion, $idEmpActualiza);
      echo $rspta!=0?"Categoria actualizada":"Error categoria no actualizada";
    }
    
    break;
/*
  case 'mostrar':
    $rspta=$categoria->mostrar($idCategoria);
    echo json_encode($rspta);
    break;

  case 'desactivar':
  $rspta=$categoria->desactivar($idCategoria);
  echo $rspta?"Categoría desactivada":"Error categoría no desactivada";
  break;

  case 'activar':
  $rspta=$categoria->activar($idCategoria);
  echo $rspta?"Categoría activada":"Error categoría no activada";
  break;
*/
    }


?>