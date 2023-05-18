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
  <div class="row">
   <div class="col-md-6">
    <h1>Búsqueda de Cita</h1>
    <form method="post">
     <div class="form-group">
      <label for="numbersInput"></label>
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
   $queryIdentidad = "
            SELECT
                tbl_cita.idCita,
                tbl_cita.fechaNacimiento,
                tbl_consulado.nombre AS Consulado,
                tbl_producto.nombreProducto AS nombreProducto,
                tbl_cita.fechaHoraCita AS horaCita,
                tbl_cita.nombre,
                tbl_cita.apellido,
                tbl_cita.identidad,
                tbl_horario_consulado.horaFinal AS horaAtencion,
                tbl_cita.estado,
                tbl_usuario.nombre AS agente
            FROM
                tbl_cita
                INNER JOIN tbl_usuario ON tbl_cita.idUsuarioCI = tbl_usuario.idUsuario
                INNER JOIN tbl_producto ON tbl_cita.idProducto = tbl_producto.idProducto
                INNER JOIN tbl_horario_consulado ON tbl_cita.idHorarioConsulado = tbl_horario_consulado.idHorarioConsulado
                INNER JOIN tbl_consulado ON tbl_cita.idConsulado = tbl_consulado.idConsulado
            WHERE
                tbl_cita.identidad = :identidad
            ORDER BY
                tbl_horario_consulado.horaFinal ASC";

   // Execute the query
   $stmt = $pdo->prepare($queryIdentidad);
   $stmt->bindValue(':identidad', $identidad, PDO::PARAM_STR);
   $stmt->execute();

   // Fetch the user data
   $results = $stmt->fetchAll(PDO::FETCH_BOTH);

   // Check if there are any results
   if ($results) {
    // Display the user information in a table
    echo '<div class="container">
                        <table class="table table-striped">
                            <tbody>';

    foreach ($results as $row) {

     echo '<tr>
                            <th>Numero Del Caso:</th>
                            <td>' . $row['idCita'] . '</td>
                          </tr>';

     echo '<tr>
                            <th>Fecha Nacimiento:</th>
                            <td>' . $row['fechaNacimiento'] . '</td>
                          </tr>';

     echo '<tr>
                            <th>Consulado:</th>
                            <td>' . $row['Consulado'] . '</td>
                          </tr>';

     echo '<tr>
                            <th>Nombre Producto:</th>
                            <td>' . $row['nombreProducto'] . '</td>
                          </tr>';

     echo '<tr>
                            <th>Fecha de la Cita:</th>
                            <td>' . $row['horaCita'] . '</td>
                          </tr>';

     echo '<tr>
                            <th>Nombre</th>
                            <td>' . $row['nombre'] . '</td>
                          </tr>';

     echo '<tr>
                            <th>Apellido:</th>
                            <td>' . $row['apellido'] . '</td>
                          </tr>';

     echo '<tr>
                            <th>Identidad</th>
                            <td>' . $row['identidad'] . '</td>
                          </tr>';

     echo '<tr>
                            <th>Hora Atencion:</th>
                            <td>' . $row['horaAtencion'] . '</td>
                          </tr>';

     echo '<tr>
                            <th>Agente:</th>
                            <td>' . $row['agente'] . '</td>
                          </tr>';
    }
    echo '</tbody></table></div>';
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


<!-- 1701198801689 -->