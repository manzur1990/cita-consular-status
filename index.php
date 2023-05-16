<!DOCTYPE html>
<html>

<head>
 <title>Status de Cita Consular</title>
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
    <h1>Buesqueda de Cita</h1>
    <form method="POST" action="controller.php">
     <div class="form-group">
      <label for="numbersInput">DNI</label>
      <input type="text" class="form-control" id="numbersInput" name="numbersInput" placeholder="Número de Identidad">
     </div>
     <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
   </div>
  </div>
 </div>

 <!-- Bootstrap JS -->
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>