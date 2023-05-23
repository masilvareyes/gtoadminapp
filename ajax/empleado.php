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
        $nombre=encryption($nombre);
    	$primerApellido=encryption($primerApellido);
    	$segundoApellido=encryption($segundoApellido);
      $pwd=set_pass($pwd);
        $rspta=$empleado->insertar($nombre, $primerApellido, $segundoApellido, $email, $fechaEntrada, $fechaBaja, $idDepartamento, $idJefe, (strlen($esJefe)<1)?0:1, $usr, $pwd, $imagen, $idEmpActualiza);

        echo $rspta!=0?"Empleado registrado":"Error empleado no resgistrado";
      }else{  //Registros ya existentes
        $hashValidador=hash("SHA256","Contraseña no actualizada");
        //write_log("Ajax empleado - editar valor de hashValidador: $hashValidador || pwd = $pwd");
  
        if($pwd == $hashValidador){
          $pwd="";
          write_log("Ajax empleado - editar iguales valor de hashValidador: $hashValidador || pwd = $pwd");
        }else{
          $pwd=set_pass($pwd);
          write_log("Ajax empleado - editar diferentes valor de hashValidador: $hashValidador || pwd = $pwd");
        }
        $nombre=encryption($nombre);
        $primerApellido=encryption($primerApellido);
        $segundoApellido=encryption($segundoApellido);
  
        $rspta=$empleado->editar($idEmpleado, $nombre, $primerApellido, $segundoApellido, $email, $fechaEntrada, $fechaBaja, $idDepartamento, $idJefe, (strlen($esJefe)<1)?0:1, $usr, $pwd, $imagen, $fechaActualizacion, $idEmpActualiza);
        echo $rspta!=0?"Empleado actualizado":"Error empleado no actualizado";
      }
     break;



     case 'listar':
      $rspta=$empleado->listar();
      $data=Array();
      while ($reg=$rspta->fetch_object()){
        $data[]=array(
          "0"=>($reg->activo)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idEmpleado.')"><i class="far fa-edit"></i></button>'.
          ' <button class="btn btn-danger" onclick="desactivar('.$reg->idEmpleado.')"><i class="far fa-window-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idEmpleado.')"><i class="far fa-edit"></i></button>'.
          ' <button class="btn btn-primary" onclick="activar('.$reg->idEmpleado.')"><i class="far fa-check-square"></i></button>',
          "1"=>decryption($reg->nombre),
          "2"=>decryption($reg->primerApellido),
          "3"=>$reg->descripcion,
          "4"=>decryption($reg->jefeNombre).' '.decryption($reg->jefePrimerApellido),
          "5"=>$reg->fechaEntrada,
          "6"=>$reg->fechaCreacion,
          "7"=>$reg->fechaActualizacion,
          "8"=>($reg->activo)?'<span class="badge badge-success">Activado</span>':'<span class="badge badge-danger">Desactivado</span>',
          "9"=>decryption($reg->nombreAct).' '.decryption($reg->primerApellidoAct),
        );
      }
      $results=array(
        "sEcho"=>1, //informacion para el datatables
        "iTotalRecords"=>count($data),
        "iTotalDisplayRecords"=>count($data),
        "aaData"=>$data);
      echo json_encode($results);
  
    break;
  
    case 'selectJefe':
      $rspta=$empleado->selectJefe();
  
      while ($reg = $rspta->fetch_object()){
        echo "<option value='".$reg->idEmpleado."'>".decryption($reg->nombre)." ".decryption($reg->primerApellido)."</option>";
      }
      
    break; 
	  case 'mostrar':
	    $rspta=$empleado->mostrar($idEmpleado);

      //write_log(" Ajax Empleado Caso Mostrar");
      //write_log(json_encode($rspta));

      $rspta["nombre"]=decryption($rspta["nombre"]);
      $rspta["primerApellido"]=decryption($rspta["primerApellido"]);
      $rspta["segundoApellido"]=decryption($rspta["segundoApellido"]);

      if(strlen(strtotime($rspta["fechaEntrada"]))>1){
        $rspta["fechaEntrada"]=date("Y-m-d",strtotime($rspta["fechaEntrada"]));
      }
      if(strlen(strtotime($rspta["fechaBaja"]))>1){
        $rspta["fechaBaja"]=date("Y-m-d",strtotime($rspta["fechaBaja"]));
      }

    $rspta["pwd"]=hash("SHA256","Contraseña no actualizada");     


	  echo json_encode($rspta);
	  break;
    

  case 'desactivar':
  $rspta=$empleado->desactivar($idEmpleado,$fechaActualizacion,$idEmpActualiza);
  echo $rspta?"Empleado dado de baja":"Error al dar de baja al empleado";
  break;

  case 'activar':
  $rspta=$empleado->activar($idEmpleado,$fechaActualizacion,$idEmpActualiza);
  echo $rspta?"Empleado reactivado":"Error al reactivar al empleado";
  break;

    }


?>