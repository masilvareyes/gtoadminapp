<?php
  require 'cabecero.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">EMPLEADOS <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fas fa-plus-circle"></i> Agregar</button></h3>
        </div>
        <div class="card-body">
            <!--  Contenedor de listados   -->  
          <div class="panel-body" id="listadoregdata">
              <table id="tblistadoregdata" class="table table-striped table-bordered table-condensed table-over"> 
                  <thead> 
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Departamento</th>
                    <th>Jefe</th>
                    <th>Fecha de Ingreso</th>
                    <th>Fecha de creación</th>
                    <th>Fecha de actualización</th>
                    <th>Status</th>
                    <th>Empleado modifico</th>  
                  </thead>
                  <tbody> 
                  </tbody>
                  <thead> 
 					<th>Opciones</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Departamento</th>
                    <th>Jefe</th>
                    <th>Fecha de Ingreso</th>
                    <th>Fecha de creación</th>
                    <th>Fecha de actualización</th>
                    <th>Status</th>
                    <th>Empleado modifico</th> 
                  </thead>
              </table> 
          </div>

          <!--  Contenedor de formuluario --> 
          <div class="panel-body" id="formregdata">
            <form name="formulario" id="formulario" method="post" class="row">
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="nombre">Nombre del Empleado</label>
                <input type="hidden" name="idEmpleado" id="idEmpleado">
                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="256" placeholder="Nombre Empleado" required>
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="primerApellido">Primer Apellido</label>
                <input type="text" class="form-control" name="primerApellido" id="primerApellido" maxlength="256" placeholder="Primer Apellido" required>
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="segundoApellido">Segundo Apellido</label>
                <input type="text" class="form-control" name="segundoApellido" id="segundoApellido" maxlength="256" placeholder="Segundo Apellido" required>
              </div>
			        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="email">email</label>
                <div class="input-group mb-2">
			        <div class="input-group-prepend">
			          <div class="input-group-text">@</div>
			        </div>
	                <input type="email" class="form-control" name="email" id="email" maxlength="256" placeholder="email" required>
	            </div>
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="fechaEntrada">Fecha de Ingresgo</label>
                <input type="date" class="form-control" name="fechaEntrada" id="fechaEntrada" maxlength="256" placeholder="Fecha Ingreso" required>
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="fechaBaja">Fecha de baja</label>
                <input type="date" class="form-control" name="fechaBaja" id="fechaBaja" maxlength="256" placeholder="Fecha Ingreso" required>
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="idDepartamento">Departamento</label>
                <select class="form-control selectpicker" data-live-search="true" name="idDepartamento" id="idDepartamento" required>
                </select>
              </div> 
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="idJefe">Jefe</label>
                <select class="form-control selectpicker" data-live-search="true" name="idJefe" id="idJefe" required>
                </select>
              </div> 
              <div class="form-check col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="idJefe">Es Jefe</label>
                <div class="custom-control custom-switch">
                	<input class="custom-control-input" type="checkbox" name="esJefe" id="esJefe" required>
              		<label class="custom-control-label"  for="esJefe">Si</label>
                </div>
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="usr">Usuario</label>
                <input class="form-control" type="text" name="usr" id="usr" maxlength="256" placeholder="Usuario" required>
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="pwd">Contraseña</label>
                <input class="form-control" type="password" name="pwd" id="pwd" maxlength="256" placeholder="Contraseña" required>
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
              	<label>Foto de empleado</label>
              	<div class="custom-file">
                	<input type="file" class="custom-file-input" name="foto" id="foto">
                	<label  class="custom-file-label" for="foto">foto</label>
            	</div>
              </div>

              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <button class="btn btn-primary" id="btnGuardar" type="submit"><i class="fas fa-save"></i> Guardar</button>
                <button class="btn btn-danger" id="btnCancelar" type="submit" onclick="cancelarform()"><i class="fas fa-arrow-circle-left"></i> Cancelar</button>  
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <input class="form-control" type="hidden" name="fotoActual" id="fotoActual">
                <img src="" width="150px" height="150px" id="imagenmuestra">
              </div>
            </form>
          </div>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  require 'piepagina.php'
?>
<!--<script type="text/javascript" src="scripts/empleado.js"></script>-->
