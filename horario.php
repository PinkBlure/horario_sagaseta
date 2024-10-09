<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horario IES Fernando Sagaseta</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="body">

    <?php
        $horas = ["8:00", "8:55", "9:50", "10:45", "11:15", "12:10", "13:05", "14:00", "14:55"];

        date_default_timezone_set("Atlantic/Canary");
        define("DIA", date("d-m-Y"));

        $formatter = new IntlDateFormatter(
            'es_ES',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'Atlantic/Canary',
            IntlDateFormatter::GREGORIAN,
            'EEEE');
        $timestamp = strtotime(DIA);
        $diaSemana = $formatter->format($timestamp);
        $diaSemana = ucfirst($diaSemana);

        define("HORA", date("H:i"));
    ?>

    <header class="header container py-3">
    <div class="row align-items-center">
        <div class="col-12 col-md-6">
            <img class="header__image img-fluid" src="./img/logo-ies-1.svg" alt="logo sagaseta">
        </div>
        <div class="col-12 col-md-6 text-md-right text-center">
            <?php
                echo "<h1 class='header__text h4'>$diaSemana, " . DIA . " a las " . HORA . "</h1>";
            ?>
        </div>
    </div>
    </header>


    <main>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $datos = leerSeleccion($horas);
                if ($datos !== null) {
                    $data = $datos['data'];
                    $dia = $datos['dia'];
                    $hora = $datos['hora'];
                }
                
            }

            function leerSeleccion($horas) {
                $horario = $_POST["horario"];
                $dia = $_POST["dia"];
                $hora = $_POST["hora"];

                echo "<h2>Visualizando el horario $horario</h2>";

                $archivo = "./data/$horario.json";

                if (!file_exists($archivo)) {
                    echo "<p class='p__busqueda'>La ruta no es correcta.</p>";
                    return;
                }
                    
                $json = file_get_contents($archivo);
                    
                $data = json_decode($json, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo "Error al decodificar el JSON: " . json_last_error_msg();
                    exit;
                }

                return ["data" => $data, "dia" => $dia, "hora" => $hora];
            }
        ?>

        <table border="1" class="table">
            <tr>
                <th>Horario</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
            <?php
                rellenarTabla($data, $horas);
            
                function rellenarTabla($data, $horas) {
                    foreach ($data as $key => $dias) {
                        $row = "<tr><td style='text-align: center; padding: .8rem'>{$horas[$key-1]} - {$horas[$key]}</td>";
                        foreach ($dias as $dia => $detalles) {
                            $row .= "<td style='text-align: center; padding: .8rem'>"
                                .($detalles['Grupo'] ? $detalles['Grupo'] : "---")
                                ."<br>"
                                .($detalles['Materia'] ? $detalles['Materia'] : "---")
                                ."<br>"
                                .($detalles['Aula'] ? $detalles['Aula'] : "---")
                                ."</td>";
                        }
                        echo "$row</tr>";
                    }
                }
            ?>
        </table>

        <form method="post">
            <div class="form">
                <label for="horario">Selecciona horario: </label>
                <select id="horario" name="horario" required>
                    <option value="" disabled selected>-- Selecciona un horario--</option>
                    <option value="P_David">David</option>
                    <option value="P_Badel">Badel</option>
                    <option value="P_Acerina">Acerina</option>
                    <option value="2ºCFGS_INF">2º CFGS INF. Desarrollo de aplicaciones web</option>
                </select>
                <label for="dia">Selecciona dia: </label>
                <select id="dia" name="dia">
                    <option value="" disabled selected>-- Selecciona un día --</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miércoles">Miércoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                </select>
                <label for="hora">Selecciona hora: </label>
                <select id="hora" name="hora">
                    <option value="" disabled selected>-- Selecciona una hora --</option>
                    <option value="1"><?= "$horas[0] - $horas[1]"; ?></option>
                    <option value="2"><?= "$horas[1] - $horas[2]"; ?></option>
                    <option value="3"><?= "$horas[2] - $horas[3]"; ?></option>
                    <option value="4"><?= "$horas[3] - $horas[4]"; ?></option>
                    <option value="5"><?= "$horas[4] - $horas[5]"; ?></option>
                    <option value="6"><?= "$horas[5] - $horas[6]"; ?></option>
                    <option value="7"><?= "$horas[6] - $horas[7]"; ?></option>
                    <option value="8"><?= "$horas[7] - $horas[8]"; ?></option>
                </select>
            </div>
            <input class="input" type="submit" value="Buscar ubicación">
        </form>

        <h2>El profesor o grupo actualmente se encuentra en: </h2>
        <?php
            foreach ($data as $keydatos => $dias) {
                foreach ($dias as $diadatos => $detalles) {
                    if (buscarHora($horas) != -1) {
                        if (($horas[$keydatos-1] == buscarHora($horas)) && ($diadatos == $diaSemana)) {
                            echo "<p class='p__busqueda'>Grupo: "
                            .($detalles['Grupo'] ? $detalles['Grupo'] : "---")
                            ."<br>Materia: "
                            .($detalles['Materia'] ? $detalles['Materia'] : "---")
                            ."<br>Aula: "
                            .($detalles['Aula'] ? $detalles['Aula'] : "---")
                            ."<br></p>";
                        }
                    } else {
                        echo "<p class='p__busqueda'>Esta hora no es lectiva para el centro.</p>";
                    }
                }
            }

            function buscarHora($horas) {
                for ( $i = 0; $i < count($horas)-1; $i++) {
                    $hora_anterior = DateTime::createFromFormat('H:i', $horas[$i]);
                    $hora_posterior = DateTime::createFromFormat('H:i', $horas[$i+1]);
                    $hora_actual = DateTime::createFromFormat('H:i', HORA);
    
                    if (($hora_anterior <= $hora_actual) && ($hora_posterior > $hora_actual)) {
                        return $horas[$i];
                    }
                } return -1;
            }
        ?>

        <h2>El profesor o grupo en la hora y día seleccionados se encuentra en: </h2>
        <?php
            busqueda($data, $hora, $dia);

            function busqueda($data, $hora, $dia) {

                if ($hora == "" || $dia == "") {
                    echo "<p class='p__busqueda'>Debes seleccionar una hora y día para este apartado.<p>";
                } else {
                    foreach ($data as $keydatos => $dias) {
                        foreach ($dias as $diadatos => $detalles) {
                            if (($keydatos == $hora) && ($diadatos == $dia)) {
                                echo "<p class='p__busqueda'>Grupo: "
                                .($detalles['Grupo'] ? $detalles['Grupo'] : "---")
                                ."<br>Materia: "
                                .($detalles['Materia'] ? $detalles['Materia'] : "---")
                                ."<br>Aula: "
                                .($detalles['Aula'] ? $detalles['Aula'] : "---")
                                ."<br></p>";
                            }
                        }
                    }
                }

                
            }
        ?>

        <div>
            <a class="input" href="formulario_horario.php">Añadir un nuevo horario</a>
        </div>

    </main>

</body>
</html>
