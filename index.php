<?php
$comunidades = [
        "Andalucía" => ["Córdoba", "Sevilla", "Huelva", "Almería", "Jaén", "Cádiz", "Málaga"],
        "Extremadura" => ["Cáceres", "Badajoz"],
        "Murcia" => ["Murcia"],
        "Comunidad Valenciana" => ["Valencia", "Alicante", "Castellón"],
        "Castilla la Mancha" => ["Guadalajara", "Toledo", "Ciudad Real", "Cuenca", "Albacete"],
        "Castilla y León" => ["Valladolid", "Burgos", "León", "Salamanca", "Ávila", "Segovia", "Zamora", "Soria", "Palencia", "Segovia", "Ávila"],
        "Madrid" => ["Madrid"],
        "Cataluña" => ["Barcelona", "Girona", "Lleida", "Tarragona"],
        "Galicia" => ["A Coruña", "Lugo", "Ourense", "Pontevedra"],
        "País Vasco" => ["Álava", "Vizcaya", "Guipúzcoa"],
        "Cantabria" => ["Cantabria"],
        "Asturias" => ["Asturias"],
        "Aragón" => ["Zaragoza", "Huesca", "Teruel"],
        "La Rioja" => ["La Rioja"],
        "Baleares" => ["Islas Baleares"],
        "Canarias" => ["Las Palmas", "Santa Cruz de Tenerife"],
        "Navarra" => ["Navarra"]

    
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
            echo "<p class=correcto>¡Correcto! $provinciaAleatoria pertenece a $respuestaCorrecta.</p>";
        } else {
            echo "<p class=incorrecto>Incorrecto $provinciaAleatoria pertenece a $respuestaCorrecta, no a $respuestaUsuario.</p>";
        }
    }
    ?>

    <form method="post">
        <p>¿A qué comunidad autónoma pertenece la provincia <strong><?php echo $provinciaAleatoria; ?></strong>?</p>
        <select name="respuesta">
            <?php
            // Mostrar opciones con las comunidades
            foreach ($comunidades as $comunidad => $listaProvincias) {
                echo "<option value=\"$comunidad\">$comunidad</option>";
            }
            ?>
        </select>
        <!-- Campo oculto que sirve para saber que provincia es para que lo sepa el servidor -->
        <input type="hidden" name="provincia" value="<?php echo $provinciaAleatoria; ?>">
        <br><br>
        <input type="submit" value="Responder">
    </form>

    <form method="post">
        <input type="submit" value="Nueva Pregunta">
    </form>
</body>
</html>
