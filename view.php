<!DOCTYPE html>
<html>

<head>
 <title>Result</title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
 <div class="container mt-4">
  <div class="container mt-4">
   <h1>Resultado</h1>

   <table class="table table-bordered">
    <thead>
     <tr>
      <th>ID</th>
      <th>Nombre</th>
     </tr>
    </thead>
    <tbody>
     <?php foreach ($results as $result) { ?>
      <tr>
       <td><?php echo $result['number']; ?></td>
       <td><?php echo $result['square']; ?></td>
      </tr>
     <?php } ?>
    </tbody>
   </table>

   <a href="index.php" class="btn btn-primary">Atras</a>

   <table class="table table-bordered">
    <thead