<?php   
require_once "../modelos/Departamento.php";
$departamento=new Departamento();

//Obtenemos nuestras variables del arreglo post
$idDepartamento=isset($_POST['idDepartamento'])?limpiarCadenas($_POST['idDepartamento']):"";
$descripcion=isset($_POST['descripcion'])?limpiarCadenas($_POST['descripcion']):"";

//Agregamos lógica para fechas de registro y variables auxiliares 
$fechaActualizacion=date("Y-m-d H:i:s");
$idEmpActualiza=1; // Cambiar por el usuario de la sesion.


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
        "aaData"=>$data
      );

      echo json_encode($results);

    break;
    //Agregamos caso de guardar y editar
    case 'guardaryeditar':
      //Agregamos validación para saber si tenemos que guardar una edición o crear un nuevo registro
      if(empty($idDepartamento)){
        //Ejecutamos la instrucción de insertar
        $rspta=$departamento->insertar($descripcion);
        //Configuramos el mensaje de respuesta
        echo $rspta!=0?"Departamento registrado":"Error departamento no resgistrado";
      }else{
        //Ejecutamos la instrucción de editar
        $rspta=$departamento->editar($idDepartamento, $descripcion, $fechaActualizacion, $idEmpActualiza);
        //Configuramos el mensaje de respuesta
        echo $rspta!=0?"Departamento actualizado":"Error departamento no actualizado";
      }
      
    break;
    //Establecemos el caso para la opción mostrar
    case 'mostrar':
      //Llamamos al método mostrar de nuestro objeto
      $rspta=$departamento->mostrar($idDepartamento);
      //codificamos a json el resultado para que viaje correctamente por request.
      echo json_encode($rspta);
    break;

    //Creamos el caso para desactivar
    case 'desactivar':
      //Mandamos a ejecutar el método para desactivar de nuestro objeto
      $rspta=$departamento->desactivar($idDepartamento);
      //Configuramos mensaje de respuesta
      echo $rspta?"Departamento desactivado":"Error departamento no desactivado";
    break;
    
    //Reutilizamos el código para implementar la funcionalidad de activar.
    case 'activar':
      $rspta=$departamento->activar($idDepartamento);
      echo $rspta?"Departamento activado":"Error departamento no activado";
    break;

    // Caso para generar de manera dinámica las opciones del select con los elementos activos
    // obtenidos desde la base.
    case 'select':
      $rspta =$departamento->select();
      while ($reg = $rspta->fetch_object()){
        echo "<option value='".$reg->idDepartamento."'>".$reg->descripcion."</option>";
      }
    break;
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