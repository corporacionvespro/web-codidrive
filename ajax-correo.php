<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


try{
    //variables 
    $nombres = $_POST["nombres"];
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];
    $descripcion = $_POST["descripcion"];
    
    try {
       
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'codi.drive@gmail.com';                     // SMTP username
        $mail->Password   = 'mlotzywrnxxfwywx';                               // SMP passwordT
        $mail->SMTPSecure = 'SMTP';                                  // Enable TLS encryption, `ssl` also accepted
        // $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        // $mail->Port       = 587;                                    // TCP port to connect to
        // $mail->Port       = 465;                                    // TCP port to connect to
        $mail->Port       = 25;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('codi.drive@gmail.com', 'Codi Drive');
        $mail->addAddress('codi.drive@gmail.com');     // Add a recipient
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Codi: '.$nombres;
        $mail->Body    = '<b>Nombre de empresa:</b> '.$nombres.'<br>';
        $mail->Body    = $mail->Body.'<b>Celular:</b> '.$celular.'<br>';
        $mail->Body    = $mail->Body.'<b>Correo:</b> '.$correo.'<br>';
        $mail->Body    = $mail->Body.'<b>Descripción:</b> '.$descripcion.'<br>';
       
        header('Content-Type: application/json');    
        if (!$mail->send()) {
            echo json_encode([
                "status"    => "ERROR",
                "data"      => $mail->ErrorInfo
            ]);
        }else {
            echo json_encode([
                "status"    => "OK",
                "data"      => "Mensaje enviado."
            ]);
        }
    }catch (\Exception $e) {
        header('Content-Type: application/json');    
        echo json_encode([
            "status"    => "ERROR",
            "data"      => $mail->ErrorInfo
        ]);
    }
}catch(\Exception $e){
    header('Content-Type: application/json');    
    echo json_encode([
        "status"    => "ERROR",
        "data"      => $e->getMessage()
    ]);
}
?>