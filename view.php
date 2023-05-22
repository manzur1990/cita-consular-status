<!DOCTYPE html>
<html>

<head>
  <title>Result</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- CSS Styles -->
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* Custom CSS styles */

    .button-container {
      display: flex;
      justify-content: flex-end;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <?php
  // Your PHP code here
  ?>

  <!-- Table section -->
  <div class="container">
    <table class="table table-striped">
      <h1>Resultado</h1>
      <tbody>
        <?php
        // Your PHP code here to generate the table rows
        require_once 'includes/db_connect.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Retrieve the user ID from the form
          $identidad = $_POST['identidad'];

          try {
            require_once 'query.php';

            // Execute the query
            $stmt = $pdo->prepare($queryIdentidad);
            $stmt->bindValue(':identidad', $identidad, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch the user data
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if there are any results
            if ($results) {
              echo '<div class="container">
                <table class="table table-striped">
                  <tbody>';
              $res = var_dump($results[0]);
              echo $res;
              foreach ($results as $row) {
                echo '<p>Informacion de cita(s) de ' . $row['nombre'] . ' ' . $row['apellido'] . '</p>';

                echo '<tr>
                  <th>Nombre del Producto:</th>
                  <td>' . $row['nombreProducto'] . '</td>
                </tr>';

                echo '<tr>
                  <th>Consulado:</th>
                  <td>' . $row['Consulado'] . '</td>
                </tr>';

                echo '<tr>
                  <th>Fecha de la Cita:</th>
                  <td>' . $row['fechaCita'] . '</td>
                </tr>';
              }
              echo '</tbody></table></div>';

              // Button section
              echo '<div class="container">
                <div class="button-container">
                  </div>
                  <div class="back_button_container">
                    <a href="javascript:history.back()" class="btn btn-primary">Regresar</a>
                  </div>
                </div>
              </div>';
            } else {
              echo 'No se encontró la cita.';
            }
          } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
          }
          exit();
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- JavaScript code -->
  <script src="script.js"></script>

</body>

</html>