<!DOCTYPE html>
<html>

<head>
 <title>Result</title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <style>
  .form-group {
   margin-bottom: 1rem;
  }

  .center-content {
   display: flex;
   justify-content: center;
   align-items: center;
   height: 100vh;
  }
 </style>
</head>

<body>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Citas Consulares</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
   <ul class="navbar-nav">
    <li class="nav-item">
     <a class="nav-link" target="_blank" href="http://citaconsular.sreci.gob.hn/citaconsular/pages/layout/CitaConsular.php">Servicios Consulares</a>
    </li>
    <li class="nav-item">
     <a class="nav-link" target="_blank" href="https://sreci.gob.hn/">SRECI</a>
    </li>
   </ul>
  </div>
 </nav>

 <div class="container">
  <div class="row justify-content-center center-content">
   <div class="col-md-6">
    <h1>Búsqueda de Cita</h1>
    <form method="post">
     <div class="form-group">
      <label for="numbersInput">DNI</label>
      <input type="text" class="form-control" id="identidad" name="identidad" placeholder="Número de Identidad">
     </div>
     <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
   </div>
  </div>
 </div>

 <?php
 // Database configuration
 $host = '127.0.0.1';
 $dbname = 'citas_consulares';
 $username = 'root';
 $password = 'your_password';

 try {
  // Connect to the database
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Check if the form was submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Retrieve the user ID from the form
   $identidad = $_POST['identidad'];

   // Prepare the SQL query
   // $queryIdentidad = "
   //          SELECT
   //              tbl_cita.idCita,
   //              tbl_cita.idUsuarioCI,
   //              tbl_cita.fechaNacimiento,
   //              tbl_consulado.nombre AS Consulado,
   //              tbl_producto.nombreProducto AS nombreProducto,
   //              tbl_cita.fechaHoraCita AS horaCita,
   //              tbl_cita.nombre,
   //              tbl_cita.apellido,
   //              tbl_cita.identidad,
   //              tbl_cita.email,
   //              tbl_horario_consulado.horaFinal AS horaAtencion,
   //              tbl_cita.estado,
   //              tbl_cita.fechaCreacion,
   //              tbl_usuario.nombre AS agente
   //          FROM
   //              tbl_cita
   //              INNER JOIN tbl_usuario ON tbl_cita.idUsuarioCI = tbl_usuario.idUsuario
   //              INNER JOIN tbl_producto ON tbl_cita.idProducto = tbl_producto.idProducto
   //              INNER JOIN tbl_horario_consulado ON tbl_cita.idHorarioConsulado = tbl_horario_consulado.idHorarioConsulado
   //              INNER JOIN tbl_consulado ON tbl_cita.idConsulado = tbl_consulado.idConsulado
   //          WHERE
   //              tbl_cita.identidad = :identidad
   //          ORDER BY
   //              tbl_horario_consulado.horaFinal ASC";

   // Execute the query
   // $stmt = $pdo->prepare($query);
   // $stmt->bindValue(':identidad', $identidad, PDO::PARAM_STR);
   // $stmt->execute();

   // Fetch the user data
   // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // Check if there are any results
   // if ($results) {
   //  // Display the user information in a table
   //  echo '<div class="container">
   //                      <table class="table table-striped">
   //                          <tbody>';

   //  foreach ($results as $row) {
   //   echo '<tr>
   //                          <th>Numero Del Caso:</th>
   //                          <td>' . $row['idCita'] . '</td>
   //                        </tr>';

   //   echo '<tr>
   //                          <th>Fecha Nacimiento:</th>
   //                          <td>' . $row['fechaNacimiento'] . '</td>
   //                        </tr>';

   //   echo '<tr>
   //                          <th>Consulado:</th>
   //                          <td>' . $row['Consulado'] . '</td>
   //                        </tr>';

   //   echo '<tr>
   //                          <th>Nombre Producto:</th>
   //                          <td>' . $row['nombreProducto'] . '</td>
   //                        </tr>';

   //   echo '<tr>
   //                          <th>Fecha Hora Cita:</th>
   //                          <td>' . $row['horaCita'] . '</td>
   //                        </tr>';

   //   echo '<tr>
   //                          <th>Nombre</th>
   //                          <td>' . $row['nombre'] . '</td>
   //                        </tr>';

   //   echo '<tr>
   //                          <th>Apellido:</th>
   //                          <td>' . $row['apellido'] . '</td>
   //                        </tr>';

   //   echo '<tr>
   //                          <th>Identidad</th>
   //                          <td>' . $row['identidad'] . '</td>
   //                        </tr>';

   //   echo '<tr>
   //                          <th>Hora Atencion:</th>
   //                          <td>' . $row['horaAtencion'] . '</td>
   //                        </tr>';

   //   echo '<tr>
   //                          <th>Agente:</th>
   //                          <td>' . $row['agente'] . '</td>
   //                        </tr>';
   //  }

   //  echo '</tbody></table></div>';
   // }


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
    WHERE tbl_cita.identidad like '$identidad'
    ORDER BY tbl_horario_consulado.horaFinal ASC";
    $resultado = $mysqli->query($queryIdentidad);

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
    while ($row2 = $resultado->fetch_assoc()) {
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
   } else {
    echo 'No se encontro la cita.';
   }
  }
 } catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage();
 }
 ?>

 <!-- Bootstrap JS -->
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>