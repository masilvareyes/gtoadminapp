<!--Archivo Inicio -->
<!--al principio -->
<?php

require 'cabecero.php';

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Legacy User Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Legacy User Menu</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
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