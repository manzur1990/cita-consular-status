<!DOCTYPE html>
<html>

<head>
  <title>Result</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="css/style.css">


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
        <form method="post" action="view.php" onsubmit="return validateForm()">
          <div class="form-group">
            <label for="numbersInput"></label>
            <input type="text" class="form-control" id="identidad" name="identidad" placeholder="Número de Identidad">
          </div>
          <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
</body>

</html>