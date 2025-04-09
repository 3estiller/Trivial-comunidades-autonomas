<?php
$comunidades = [
    "Andalucía" => ["Almería", "Cádiz", "Córdoba", "Granada", "Huelva", "Jaén", "Málaga", "Sevilla"],
    "Cataluña" => ["Barcelona", "Girona", "Lleida", "Tarragona"],
    "Comunidad de Madrid" => ["Madrid"],
    "Galicia" => ["A Coruña", "Lugo", "Ourense", "Pontevedra"],
    "Castilla y León" => ["Ávila", "Burgos", "León", "Palencia", "Salamanca", "Segovia", "Soria", "Valladolid", "Zamora"],
    "Castilla-La Mancha" => ["Albacete", "Ciudad Real", "Cuenca", "Guadalajara", "Toledo"],
    "Comunidad Valenciana" => ["Alicante", "Castellón", "Valencia"],
    "País Vasco" => ["Álava", "Guipúzcoa", "Vizcaya"],
    "Aragón" => ["Huesca", "Teruel", "Zaragoza"],
    "Extremadura" => ["Badajoz", "Cáceres"],
    "Asturias" => ["Asturias"],
    "Cantabria" => ["Cantabria"],
    "Murcia" => ["Murcia"],
    "Navarra" => ["Navarra"],
    "La Rioja" => ["La Rioja"],
    "Islas Baleares" => ["Islas Baleares"],
    "Canarias" => ["Las Palmas", "Santa Cruz de Tenerife"],
    "Ceuta" => ["Ceuta"],
    "Melilla" => ["Melilla"]
];

// Crear una lista de todas las provincias
$provincias = [];
foreach ($comunidades as $comunidad => $listaProvincias) {
    foreach ($listaProvincias as $provincia) {
        $provincias[$provincia] = $comunidad;
    }
}

// Obtener una provincia aleatoria si no hay ninguna en POST
if (!isset($_POST['provincia'])) {
    $provinciaAleatoria = array_rand($provincias);
} else {
    $provinciaAleatoria = $_POST['provincia'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cuestionario sobre Provincias y Comunidades Autónomas</title>
    <style>
        .correcto{
            color: green;
        }
        .incorrecto{
            color: red;
        }
    </style>
</head>
<body>
    <h1>Cuestionario sobre Provincias y Comunidades Autónomas</h1>

    <?php
    // Si el usuario ya ha enviado una respuesta
    if (isset($_POST['respuesta'])) {
        $respuestaUsuario = $_POST['respuesta'];
        $respuestaCorrecta = $provincias[$_POST['provincia']];

        // Verificar si la respuesta es correcta
        if ($respuestaUsuario == $respuestaCorrecta) {
            echo "<p class=correcto><strong>¡Correcto!</strong> $provinciaAleatoria pertenece a $respuestaCorrecta.</p>";
        } else {
            echo "<p class=incorrecto><strong>Incorrecto.</strong> $provinciaAleatoria pertenece a $respuestaCorrecta, no a $respuestaUsuario.</p>";
        }
    }
    ?>

    <form method="post">
        <p>¿A qué comunidad autónoma pertenece la provincia <strong><?php echo $provinciaAleatoria; ?></strong>?</p>
        <select name="respuesta">
            <?php
            // Recorremos cada comunidad autónoma y su lista de provincias
            foreach ($comunidades as $comunidad => $listaProvincias) {
                echo "<option value=\"$comunidad\">$comunidad</option>";
            }
            ?>
        </select>
        <!-- Campo oculto para que el servidor sepa cual es la provincia  -->
        <input type="hidden" name="provincia" value="<?php echo $provinciaAleatoria; ?>">
        <br><br>
        <input type="submit" value="Responder">
    </form>

    <form method="post">
        <input type="submit" value="Nueva Pregunta">
    </form>
</body>
</html>
