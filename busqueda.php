<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<section class="content-header">
 <div class="container-fluid">
  <div class="row mb-2">
   <div class="col-sm-6">
    <h3>Búsqueda de Usuarios: Prueba</h3>
    <p>Llene solo un campo para poder buscar un usuario.</p>
   </div>
  </div>
 </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-12">

    <div class="card">
     <div class="card-header">
      <form action="" method="post">
       <div class="form-row">
        <div class="form-group col-md-6">
         <label for="nombre">Nombre: </label>
         <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group col-md-6">
         <label for="apellido">Apellido: </label>
         <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
        </div>
       </div>
       <div class="form-group">
        <label for="identidad">Identidad: </label>
        <input type="TEXT" class="form-control" id="identidad" name="identidad" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="0000000000000" maxlength="13">
       </div>
       <button type="submit" name="submit" class="btn btn-primary">BUSCAR</button>
      </form>
     </div>

     <!-- /.card-header -->
     <div class="card-body">
      <?php

      $mysqli = new mysqli("127.0.0.1", "root", "your_password");

      if (!$mysqli) {
       die("Failed to connect to the database: " . mysqli_connect_error());
      }

      $database_name = "citas_consulares";
      $selected_db = mysqli_select_db($mysqli, $database_name);

      if (!$selected_db) {
       die("Failed to select the database: " . mysqli_error($mysqli));
      }

      setlocale(LC_TIME, "spanish");

      if (isset($_POST['submit'])) {

       if (!empty($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $queryNombre = "SELECT
                  tbl_cita.idCita as idCita,
                  tbl_cita.idUsuarioCI as idUsuarioCI,
                  tbl_cita.fechaNacimiento,
                  tbl_consulado.nombre as Consulado,
                  tbl_producto.nombreProducto as nombreProducto,
                  tbl_cita.fechaHoraCita as horaCita,
                  tbl_cita.nombre as nombre,
                  tbl_cita.apellido as apellido,
                  tbl_cita.identidad as identidad,
          tbl_cita.email,
                  tbl_horario_consulado.horaFinal as horaAtencion,
                  tbl_cita.estado,
          tbl_cita.fechaCreacion,
          tbl_usuario.nombre as agente
                  FROM
                  tbl_cita
                  INNER JOIN tbl_usuario on tbl_cita.idUsuarioCI = tbl_usuario.idUsuario
                  INNER JOIN tbl_producto
                  ON tbl_cita.idProducto = tbl_producto.idProducto
                  INNER JOIN tbl_horario_consulado
                  ON tbl_cita.idHorarioConsulado = tbl_horario_consulado.idHorarioConsulado
                  INNER JOIN sgchdb.tbl_consulado
                  ON sgchdb.tbl_cita.idConsulado =sgchdb.tbl_consulado.idConsulado
                  WHERE tbl_cita.nombre='$nombre'
                  ORDER BY tbl_horario_consulado.horaFinal ASC";
        $resultadoNombre = $mysqli->query($queryNombre);

        echo '<table id="example1" class="table table-bordered table-striped">';
        echo '<thead style="text-align: center;">';
        echo '<tr>';
        echo '<th>Estado</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido</th>';
        echo '<th>Identidad</th>';
        echo '<th>Producto</th>';
        echo '<th>Consulado</th>';
        echo '<th>Usuario Cita Interna</th>';
        echo '<th>Fecha Cita</th>';
        echo '</tr>';
        echo '</thead">';
        echo '<tbody style="text-align: center;">';
        while ($row = $resultadoNombre->fetch_assoc()) {
         $estado = $row['estado'];
         if ($estado == 1) {
          $estado = "Atendido";
         } else if ($estado == 19) {
          $estado = "No Se Presento";
         } else if ($estado == 23) {
          $estado = "Cancelado";
         } else if ($estado == 24) {
          $estado = "Reprogramada";
         } else {
          $estado = "Pendiente";
         }
         echo '<tr>';
         echo '<td>' . $estado . '</td>';
         echo '<td>' . $row['nombre'] . '</td>';
         echo '<td>' . $row['apellido'] . '</td>';
         echo '<td>' . $row['identidad'] . '</td>';
         echo '<td>' . $row['nombreProducto'] . '</td>';
         echo '<td>' . $row['Consulado'] . '</td>';
         echo '<td>' . $row['agente'] . '</td>';
         echo '<td>' . strftime("%d-%B-%Y", strtotime($row['horaCita'])) . '</td>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<br><br><br>';
       }

       if (!empty($_POST['apellido'])) {
        $apellido = $_POST['apellido'];
        $queryApellido = "SELECT
                 tbl_cita.idCita as idCita,
                  tbl_cita.idUsuarioCI as idUsuarioCI,
                  tbl_cita.fechaNacimiento,
                  tbl_consulado.nombre as Consulado,
                  tbl_producto.nombreProducto as nombreProducto,
                  tbl_cita.fechaHoraCita as horaCita,
                  tbl_cita.nombre as nombre,
                  tbl_cita.apellido as apellido,
                  tbl_cita.identidad as identidad,
          tbl_cita.email,
                  tbl_horario_consulado.horaFinal as horaAtencion,
                  tbl_cita.estado,
          tbl_cita.fechaCreacion,
          tbl_usuario.nombre as agente
                  FROM
                  tbl_cita
                  INNER JOIN tbl_usuario on tbl_cita.idUsuarioCI = tbl_usuario.idUsuario
                  INNER JOIN tbl_producto
                  ON tbl_cita.idProducto = tbl_producto.idProducto
                  INNER JOIN tbl_horario_consulado
                  ON tbl_cita.idHorarioConsulado = tbl_horario_consulado.idHorarioConsulado
                  INNER JOIN sgchdb.tbl_consulado
                  ON sgchdb.tbl_cita.idConsulado =sgchdb.tbl_consulado.idConsulado
                  WHERE tbl_cita.apellido like '%$apellido%'
                  ORDER BY tbl_horario_consulado.horaFinal ASC";
        $resultadoApellido = $mysqli->query($queryApellido);

        echo '<table id="example2" class="table table-bordered table-striped">';
        echo '<thead style="text-align: center;">';
        echo '<tr>';
        echo '<th>Estado</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido</th>';
        echo '<th>Identidad</th>';
        echo '<th>Producto</th>';
        echo '<th>Consulado</th>';
        echo '<th>Usuario Cita Interna</th>';
        echo '<th>Fecha Cita</th>';
        echo '</tr>';
        echo '</thead">';
        echo '<tbody style="text-align: center;">';
        while ($row2 = $resultadoApellido->fetch_assoc()) {
         $estado2 = $row2['estado'];
         if ($estado2 == 1) {
          $estado2 = "Atendido";
         } else if ($estado2 == 19) {
          $estado2 = "No se Presento";
         } else if ($estado2 == 23) {
          $estado2 = "Cancelado";
         } else if ($estado2 == 24) {
          $estado2 = "Reprogramada";
         } else {
          $estado2 = "Pendiente";
         }
         echo '<tr>';
         echo '<td>' . $estado2 . '</td>';
         echo '<td>' . $row2['nombre'] . '</td>';
         echo '<td>' . $row2['apellido'] . '</td>';
         echo '<td>' . $row2['identidad'] . '</td>';
         echo '<td>' . $row2['nombreProducto'] . '</td>';
         echo '<td>' . $row2['Consulado'] . '</td>';
         echo '<td>' . $row2['agente'] . '</td>';
         echo '<td>' . strftime("%d-%B-%Y", strtotime($row2['horaCita'])) . '</td>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<br><br><br>';
       }

       if (!empty($_POST['identidad'])) {
        $identidad = $_POST['identidad'];
        $queryIdentidad = "SELECT
                  tbl_cita.idCita as idCita,
                  tbl_cita.idUsuarioCI as idUsuarioCI,
                  tbl_cita.fechaNacimiento,
                  tbl_consulado.nombre as Consulado,
                  tbl_producto.nombreProducto as nombreProducto,
                  tbl_cita.fechaHoraCita as horaCita,
                  tbl_cita.nombre as nombre,
                  tbl_cita.apellido as apellido,
                  tbl_cita.identidad as identidad,
          tbl_cita.email,
                  tbl_horario_consulado.horaFinal as horaAtencion,
                  tbl_cita.estado,
          tbl_cita.fechaCreacion,
          tbl_usuario.nombre as agente
                  FROM
                  tbl_cita
                  INNER JOIN tbl_usuario on tbl_cita.idUsuarioCI = tbl_usuario.idUsuario
                  INNER JOIN tbl_producto
                  ON tbl_cita.idProducto = tbl_producto.idProducto
                  INNER JOIN tbl_horario_consulado
                  ON tbl_cita.idHorarioConsulado = tbl_horario_consulado.idHorarioConsulado
                  INNER JOIN sgchdb.tbl_consulado
                  ON sgchdb.tbl_cita.idConsulado =sgchdb.tbl_consulado.idConsulado
                  WHERE tbl_cita.identidad='$identidad'
                  ORDER BY tbl_horario_consulado.horaFinal ASC";
        $resultadoIdentidad = $mysqli->query($queryIdentidad);

        echo '<table id="example3" class="table table-bordered table-striped">';
        echo '<thead style="text-align: center;">';
        echo '<tr>';
        echo '<th>Estado</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido</th>';
        echo '<th>Identidad</th>';
        echo '<th>Producto</th>';
        echo '<th>Consulado</th>';
        echo '<th>Usuario Cita Interna</th>';
        echo '<th>Fecha Cita</th>';
        echo '</tr>';
        echo '</thead">';
        echo '<tbody style="text-align: center;">';
        while ($row3 = $resultadoIdentidad->fetch_assoc()) {
         $estado3 = $row3['estado'];
         if ($estado3 == 1) {
          $estado3 = "Atendido";
         } else if ($estado3 == 19) {
          $estado3 = "No se Presento";
         } else if ($estado3 == 23) {
          $estado3 = "Cancelado";
         } else if ($estado3 == 24) {
          $estado3 = "Reprogramado";
         } else {
          $estado3 = "Pendiente";
         }
         echo '<tr>';
         echo '<td>' . $estado3 . '</td>';
         echo '<td>' . $row3['nombre'] . '</td>';
         echo '<td>' . $row3['apellido'] . '</td>';
         echo '<td>' . $row3['identidad'] . '</td>';
         echo '<td>' . $row3['nombreProducto'] . '</td>';
         echo '<td>' . $row3['Consulado'] . '</td>';
         echo '<td>' . $row3['agente'] . '</td>';
         echo '<td>' . strftime("%d-%B-%Y", strtotime($row3['horaCita'])) . '</td>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<br><br><br>';
       }
      }

      ?>
     </div>
     <!-- /.card-body -->
    </div>
    <!-- /.card -->
   </div>
   <!-- /.col -->
  </div>
  <!-- /.row -->
 </div>
</section>