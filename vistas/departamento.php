<!--Archivo Inicio -->
<!--al principio -->
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
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
          </div>
        </div>
        <div class="card-body">
          <!--  Contenedor de listados   -->  
          <div class="panel-body" id="listadoregdata">
              <table id="tblistadoregdata" class="table table-striped table-bordered table-condensed table-over"> 
                  <thead> 
                    <th> Descripción</th>
                    <th>  Fecha de creación</th>
                    <th>  Fecha de actualización</th>
                    <th>  Status</th>
                    <th>  Empleado modifico</th>  
                  </thead>
                  <tbody> 
                  </tbody>
                  <thead> 
                    <th> Descripción</th>
                    <th>  Fecha de creación</th>
                    <th>  Fecha de actualización</th>
                    <th>  Status</th>
                    <th>  Empleado modifi   co</th>  
                  </thead>
              </table> 
          </div>
          <!--  Contenedor de formuluario --> 
          <div class="panel-body" id="formregdata">
            <form name="formulario" id="formulario" method="post">
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <label for="descripcion">Nombre del departamento</label>
                <input type="hidden" name="idDepartamento" id="idDepartamento">
                <input type="text" name="descripcion" id="descripcion" maxlength="256" placeholder="Nombre departamento" required>
              </div>
              <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <button class="btn btn-primary" id="btnGuardar" type="submit">Guardar</button>
                <button class="btn btn-danger" id="btnCancelar" type="clear">Cancelar</button>  
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

<!--al Final -->

<?php 
require 'piepagina.php';
?>