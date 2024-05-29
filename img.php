<?php
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/Lima");
if (isset($_POST['image'])) {
    $id = $_POST['id'];
    function uploadImg($base64, $name)
    {
        $datosBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
        $path = $_SERVER['DOCUMENT_ROOT'] . '/codidrive/' . $name;
        if (!file_put_contents($path, $datosBase64)) {
            $result = 'error';
        } else {
            $result = "codidrive/". $name;
        }
        return $result;
    }
    $tipo = $_POST['tipo'];
    $imagen = $_POST['image'];
    $complementonombre = date('dmYHis');
    $url = 'https://codidrive.com/';
    $extension = '.png';
    $extension2 = '.webp';
    $nombreimg = $id .'-'. $complementonombre . $extension;
    $subir = uploadImg($imagen, $nombreimg);
    $eliminar = $_SERVER['DOCUMENT_ROOT'] . '/codidrive/' .$nombreimg;
    if ($subir == 'error') {
        echo "error";
    } else {
        $rutaimg = $_SERVER['DOCUMENT_ROOT'] .'/codidrive/' . $id . '/' . $tipo;
        $ruta = $_SERVER['DOCUMENT_ROOT'] . '/codidrive/' . $id . '/' . $tipo;
         
        $nombre = $id .'-'. $complementonombre . $extension2;
        $file = $url . $subir;
        $rutaeliminar = $url . $subir;
        $image = imagecreatefromstring(file_get_contents($file));
        ob_start();
        imagejpeg($image, NULL, 100);
        $cont = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);
        $content = imagecreatefromstring($cont);
        if (file_exists($ruta)) {
            // echo "El fichero $rutaimg existe <br>";
        } else {
             //echo "El fichero $rutaimg no existe <br>";
            mkdir($rutaimg, 0755, true);

        }
        $output = $url.'codidrive/' . $id . '/' . $tipo . "/" . $nombre;
            
        $output2 = $_SERVER['DOCUMENT_ROOT'] .'/codidrive/' . $id . '/' . $tipo . "/" . $nombre;
        imagewebp($content, $output2);
        imagedestroy($content);
        if (file_exists($eliminar)) {
            unlink($eliminar);
             //echo "El fichero $file existe <br>";
            echo $output;
        } else {
            // echo "El fichero $file no existe <br>";
            echo $output;
        }
    }
    
}
