<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horario IES Fernando Sagaseta</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php
    function prepararZonaHoraria() {
      date_default_timezone_set("Atlantic/Canary");

      $diaActual = date("d-m-Y");

      $formatter = new IntlDateFormatter(
        'es_ES',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'Atlantic/Canary',
        IntlDateFormatter::GREGORIAN,
        'EEEE'
      );
      $timestamp = strtotime($diaActual);
      $diaSemana = $formatter->format($timestamp);
      $diaSemanaActual = ucfirst($diaSemana);

      $horaActual = date("H:i");

      return [$diaActual, $diaSemanaActual, $horaActual];
    }
  ?>
</body>
</html>
