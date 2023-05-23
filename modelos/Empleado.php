<?php
//incluir la configuración de la conexion
require "../config/conexion.php";

Class Empleado{
  public function __construct(){

  }

  public function insertar($nombre, $primerApellido, $segundoApellido, $email, $fechaEntrada, $fechaBaja, $idDepartamento, $idJefe, $esJefe, $usr, $pwd, $foto, $idEmpActualiza){
    $sql= "INSERT INTO empleados (nombre, primerApellido, segundoApellido, email, fechaEntrada, fechaBaja, idDepartamento, idJefe, esJefe, usr, pwd, foto, idEmpActualiza) values ('$nombre', '$primerApellido', '$segundoApellido', '$email', '$fechaEntrada', '$fechaBaja', '$idDepartamento', '$idJefe', '$esJefe', '$usr', '$pwd', '$foto', '$idEmpActualiza')";
    return ejecutarConsultaRetornaID($sql);
  }

  public function editar($idEmpleado, $nombre, $primerApellido, $segundoApellido, $email, $fechaEntrada, $fechaBaja, $idDepartamento, $idJefe, $esJefe, $usr, $pwd, $foto, $fechaActualizacion, $idEmpActualiza){
	$password=($pwd=="")?"":"pwd='$pwd',";

    $sql="UPDATE empleados SET nombre='$nombre', primerApellido='$primerApellido', segundoApellido='$segundoApellido', email='$email', fechaEntrada='$fechaEntrada', fechaBaja='$fechaBaja', idDepartamento='$idDepartamento', idJefe='$idJefe', esJefe='$esJefe', usr='$usr',".$password." foto='$foto', fechaActualizacion='$fechaActualizacion', idEmpActualiza='$idEmpActualiza'
      WHERE idEmpleado='$idEmpleado' ";
      write_log("Modelo empleado - editar query =".$sql);
      return ejecutarConsulta($sql);
  }

  public function desactivar($idEmpleado, $fechaActualizacion, $idEmpActualiza){
    $sql= "UPDATE empleados SET activo = '0', fechaBaja='$fechaActualizacion', fechaActualizacion='$fechaActualizacion', idEmpActualiza='$idEmpActualiza'
    WHERE idEmpleado='$idEmpleado' " ;
    return ejecutarConsulta($sql);
  }

  public function activar($idEmpleado, $fechaActualizacion, $idEmpActualiza){
    $sql= "UPDATE empleados SET activo = '1',fechaEntrada='$fechaActualizacion', fechaBaja='', fechaActualizacion='$fechaActualizacion', idEmpActualiza='$idEmpActualiza'
    WHERE idEmpleado='$idEmpleado' " ;
    return ejecutarConsulta($sql);
  }

  public function mostrar($idEmpleado){
    $sql= "SELECT
		e.idEmpleado, 
		e.nombre, 
		e.primerApellido, 
		e.segundoApellido, 
		e.email, 
		e.fechaEntrada, 
		e.fechaBaja, 
		e.idDepartamento, 
		e.idJefe, 
		e.esJefe, 
		e.usr, 
		e.pwd, 
		e.foto, 
		e.activo, 
		e.fechaCreacion, 
		e.fechaActualizacion, 
		e.idEmpActualiza
		FROM empleados e
		WHERE  idEmpleado='$idEmpleado'" ;

    return ejecutarConsultaSimpleFila($sql);
  }

  public function listar(){
    $sql= "SELECT
		e.idEmpleado, 
		e.nombre, 
		e.primerApellido, 
		e.segundoApellido, 
		e.email, 
		e.fechaEntrada, 
		e.fechaBaja, 
		e.idDepartamento, 
		d.descripcion,
		e.idJefe,
		e2.nombre as jefeNombre, 
		e2.primerApellido as jefePrimerApellido,  
		e.esJefe, 
		e.usr, 
		e.pwd, 
		e.foto, 
		e.activo, 
		e.fechaCreacion, 
		e.fechaActualizacion, 
		e.idEmpActualiza,
		e3.nombre as nombreAct, 
		e3.primerApellido as primerApellidoAct
		FROM empleados e
		INNER JOIN departamentos d
		ON e.idDepartamento = d.idDepartamento
		LEFT OUTER JOIN empleados e2
		ON e.idJefe = e2.idEmpleado
		LEFT OUTER JOIN empleados e3
		ON e.idEmpActualiza = e3.idEmpleado
		WHERE e.idEmpleado <>1" ;
    return ejecutarConsulta($sql);
  }

  public function select(){
    $sql= "SELECT
		e.idEmpleado, 
		e.nombre, 
		e.primerApellido, 
		e.segundoApellido, 
		e.email, 
		e.fechaEntrada, 
		e.fechaBaja, 
		e.idDepartamento, 
		e.idJefe, 
		e.esJefe, 
		e.usr, 
		e.pwd, 
		e.foto, 
		e.activo, 
		e.fechaCreacion, 
		e.fechaActualizacion, 
		e.idEmpActualiza,
		FROM empleados e
		WHERE  idEmpleado='$idEmpleado'
    	AND activo='1'" ;
    return ejecutarConsulta($sql);
  }

  public function selectJefe(){
    $sql= "SELECT
		e.idEmpleado, 
		e.nombre, 
		e.primerApellido, 
		e.segundoApellido, 
		e.email, 
		e.fechaEntrada, 
		e.fechaBaja, 
		e.idDepartamento, 
		e.idJefe, 
		e.esJefe, 
		e.usr, 
		e.pwd, 
		e.foto, 
		e.activo, 
		e.fechaCreacion, 
		e.fechaActualizacion, 
		e.idEmpActualiza
		FROM empleados e
		WHERE  activo='1'
		AND esJefe = '1'" ;
    return ejecutarConsulta($sql);
  }
}

?>