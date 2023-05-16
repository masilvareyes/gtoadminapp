<?php 

require_once "../modelos/Empleado.php";
$empleado=new Empleado();

write_log(json_encode($_GET));
write_log(json_encode($_POST));
write_log(json_encode($_FILES));

$idEmpleado=isset($_POST['idEmpleado'])?limpiarCadenas($_POST['idEmpleado']):"";
$nombre=isset($_POST['nombre'])?limpiarCadenas($_POST['nombre']):"";
$primerApellido=isset($_POST['primerApellido'])?limpiarCadenas($_POST['primerApellido']):"";
$segundoApellido=isset($_POST['segundoApellido'])?limpiarCadenas($_POST['segundoApellido']):"";

$email=isset($_POST['email'])?limpiarCadenas($_POST['email']):"";
$fechaEntrada=isset($_POST['fechaEntrada'])?limpiarCadenas($_POST['fechaEntrada']):"";
$fechaBaja=isset($_POST['fechaBaja'])?limpiarCadenas($_POST['fechaBaja']):"";

$idDepartamento=isset($_POST['idDepartamento'])?limpiarCadenas($_POST['idDepartamento']):"";
$idJefe=isset($_POST['idJefe'])?limpiarCadenas($_POST['idJefe']):"";
$fechaBaja=isset($_POST['fechaBaja'])?limpiarCadenas($_POST['fechaBaja']):"";
$esJefe=isset($_POST['esJefe'])?limpiarCadenas($_POST['esJefe']):"";

$usr=isset($_POST['usr'])?limpiarCadenas($_POST['usr']):"";
$pwd=isset($_POST['pwd'])?limpiarCadenas($_POST['pwd']):"";

$fotoActual=isset($_POST['fotoActual'])?limpiarCadenas($_POST['fotoActual']):"";

$fechaActualizacion=date("Y-m-d H:i:s");
$idEmpActualiza=1; // Cambiar por el usuario de la sesion.
$imagen="";

switch ($_GET["op"]){
    case 'guardaryeditar':

        //Logica para identificar que imagen voy a grabar / mantener
        if(!file_exists($_FILES['foto']['tmp_name'])||!is_uploaded_file($_FILES['foto']['tmp_name'])){
            $imagen=$fotoActual;
        }else{
            $ext=explode(".", $_FILES['foto']['name']);
            if($_FILES['foto']['type']=="image/jpg"||$_FILES['foto']['type']=="image/jpeg"||$_FILES['foto']['type']=="image/png"){
                $imagen=round(microtime(true)).'.'.end($ext);
                move_uploaded_file($_FILES['foto']['tmp_name'], '../files/img/'.$imagen);
            }
        }
  
        if(strlen($imagen)<1){$imagen='default.png';}      
    
      if(empty($idEmpleado)){  //Nuevos Registros
        
      }else{  //Registros ya existentes
        //$rspta=$categoria->editar($idCategoria, $descripcion, $fechaActualizacion, $idEmpActualiza);
        //echo $rspta!=0?"Categoria actualizada":"Error categoria no actualizada";
      }
     break;


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