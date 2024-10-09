<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horario IES Fernando Sagaseta</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">

  <?php
  require_once __DIR__."/src/function.php";
  list($diaActual, $diaSemanaActual, $horaActual) = prepararZonaHoraria();
  ?>

  <header class="bg-light p-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 d-flex justify-content-start">
          <img class="header__image img-fluid" src="./img/logo-ies-1.svg" alt="logo sagaseta" style="max-width: 75px;">
        </div>
        <div class="col-6 d-flex flex-column align-items-end text-md-right">
          <?php
          echo "<h1 class='header__text h4 mb-0'>$diaSemanaActual, $diaActual a las $horaActual</h1>";
          ?>
        </div>
      </div>
    </div>
  </header>

  <main class="flex-grow-1 p-3"></main>

  <footer class="bg-light text-center p-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 d-flex justify-content-start">
          <img src="./img/logo-ies-1.svg" alt="logo sagaseta" class="img-fluid" style="max-width: 75px;">
        </div>
        <div class="col-6 d-flex flex-column align-items-end">
          <a href="https://www3.gobiernodecanarias.org/medusa/edublog/iesfernandosagaseta/" class="text-decoration-none mb-1">
            IES Fernando Sagaseta
          </a>
          <p class="mb-0">Aileen Padrón Torres - IES Fernando Sagaseta</p>
        </div>
      </div>
    </div>
  </footer>


</body>

</html>