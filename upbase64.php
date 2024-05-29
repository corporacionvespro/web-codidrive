<?php
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/Lima");
if (isset($_POST["imagen_base64"])) {
    $imagen_base64 = $_POST["imagen_base64"];

    // Decodificar el Base64
    $imagen_data = base64_decode($imagen_base64);

    // Nombre único para la imagen
    $nombre_imagen = uniqid() . '.jpg';

    // Ruta donde se guardará la imagen en el servidor
    //$ruta_imagen = 'ruta/donde/guardar/las/imagenes/' . $nombre_imagen;
    $ruta_imagen = "codidrive/categorias_asociados/".$nombre_imagen;
    // Guardar la imagen en el servidor
    file_put_contents($ruta_imagen, $imagen_data);

    // URL de la imagen
    $url_imagen = 'https://codidrive.com/codidrive/categorias_asociados/' . $nombre_imagen;

    // Devolver la URL como respuesta
    echo $url_imagen;
} else {
    echo "https://codidrive.com/admin/assets/img/brand/logo.png";
}
?>
