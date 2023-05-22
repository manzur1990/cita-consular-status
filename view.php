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
</head>

</html>

<?php
require_once 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 // Retrieve the user ID from the form
 $identidad = $_POST['identidad'];


 try {
  // Check if the form was submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   require_once 'query.php';

   // Retrieve the user ID from the form
   $identidad = $_POST['identidad'];

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
              <div class="print_button_container">
               <button type="button" class="btn btn-secondary" onclick="printTable()"><i class="fas fa-print"></i></button>
              </div>
                      <table class="table table-striped">
                          <tbody>';

    foreach ($results as $row) {

     echo '<p>Informacion de cita(s) de ' . $row['nombre'] . ' ' . $row['apellido'] . '</p>';

     echo '<tr>
           <th>Nombre Producto:</th>
           <td>' . $row['nombreProducto'] . '</td>
         </tr>';

     echo '<tr>
          <th>Consulado:</th>
          <td>' . $row['Consulado'] . '</td>
        </tr>';

     echo '<tr>
          <th>Fecha de la Cita:</th>
          <td>' . $row['horaCita'] . '</td>
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

 exit();
}
?>