<?php
include_once "bdd/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombre, pais, edad FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Tutorial CRUD 2020</title>
  </head>
  <body>
  <header>
        <h4 class="text-center text-light">CRUD con <span class="badged badge-danger">DATATABLES</span></h4>
    </header>
    <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <button id="btnNuevo" type="button" class="btn btn-success"><span class="material-icons">add_to_queue</span></button>
             </div>
         </div>
    </div>
    <div class="container">
    <div class="row">
    <div class="col-lg-12">
    <div class="table-responsive">
    <table id="tablaPersonas" class="table table-striped table-bordered" style="width:100%">
        <thead class="text-center">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Pais</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
                    foreach($data as $dat){
          ?>
                         <tr>
                            <td><?php echo $dat['id'] ?></td>
                            <td><?php echo $dat['nombre'] ?></td>
                            <td><?php echo $dat['pais'] ?></td>
                            <td><?php echo $dat['edad'] ?></td>
                            <td></td>
                         </tr>

                         <?php
                         }
                         ?>
        </tbody>
    </table>
    </div>
   </div>
  </div>
</div>
   <!--Modal para crud-->
   <div class="modal fade" id="modalcrud1" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formPersonas">
      <div class="modal-body">
            <div class="form-group">
            <label for="nombre" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre">
            </div>
            <div class="form-group">
             <label for="pais" class="col-form-label">Pais:</label>
            <input type="text" class="form-control" id="pais">
            </div>
            <div class="form-group">
            <label for="edad" class="col-form-label">Edad:</label>
            <input type="number" class="form-control" id="edad">
            </div>
        </div>
      <div class="modal-footer">
     <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
     <button type="submit"  id="btnGuardar" class="btn btn-dark" >Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal borrar-->
<div class="modal fade" id="modalborrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formBorraUser">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="btnBorrar" class="btn btn-danger">Aceptar</button>
      </div>
      </form>
    </div>
  </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="js/main.js"> </script>

  </body>
</html>