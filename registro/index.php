
<?php
class DBController {
	private $conn = "";
	private $host = "localhost";
	private $user = "root";
	private $password = "vespro@taxi";
	private $database = "landing_clientes";

	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->conn = $conn;			
		}
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	function runSelectQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
	}
	
	function executeInsert($query) {
        $result = mysqli_query($this->conn,$query);
        $insert_id = mysqli_insert_id($this->conn);
		return $insert_id;
		
    }
	function executeUpdate($query) {
        $result = mysqli_query($this->conn,$query);
        return $result;
		
    }
	
	function executeQuery($sql) {
		$result = mysqli_query($this->conn,$sql);
		return $result;
		
    }

	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;
	}
}
?>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../img/icon.png" type="image/png">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos.css" />

        <title>Regístrate con Codi</title>
        
    </head>

    <?php //update user other info
if (isset($_POST['btnRegistrar'])) {
  if (empty($errors)) {
    $nombres=$_POST["nombres"];
$correo=$_POST["correo"];
$whatsapp=$_POST["whatsapp"];
$db_handle = new DBController();
$sql ="INSERT INTO cliente ("; 
$sql .= "nombres,correo,whatsapp"; //`Dni``Apellido``Direccion
$sql .= ") VALUES (";
$sql .= " '{$nombres}','{$correo}','{$whatsapp}'";
$sql .= ")";

$result = $db_handle->executeUpdate($sql);
    
  } else {
    $session->msg("d", $errors);
    redirect('index.php', false);
  }
}
?>

    <body style="background-color: #e2ecf2;">


        <div id="contacto" class="container col-sm-12 col-md-8 col-xl-6">
            <img class="img-encabezado mx-auto d-block" src="../img/icon.png" />
            <h1 class="text-center my-4 mb-3 mx-4 color-celeste">Únete a<div class="celeste">la comunidad</div>Codi Drive</h1>
            <p class="text-center mx-4 color-azul" style="font-size: 20px; line-height: 26px;">Estamos aquí para ofrecerte una <b>experiencia de viaje diferente.</b> <b>Regístrate</b> y participa de un vale de descuento para viajar en nuestra ciudad de Chiclayo.<br>Serán 100 ganadores en este mes de Diciembre.</p>
            
            <form id="frm-contacto"  name="formulario"class="mx-4 mt-4" method="POST" action="index.php">
                <div class="form-group">
                    <input type="text" class="form-control rounded-pill" id="nombres" name="nombres" placeholder="Nombres">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control rounded-pill" id="correo" name="correo" placeholder="Correo">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control rounded-pill" id="whatsapp" name="whatsapp" placeholder="Whatsapp">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label color-azul" for="exampleCheck1" style="font-size: 15px;">Otorgo el consentimiento a Codi Drive para el uso de mis datos personales.</label>
                </div>
                <button name="btnRegistrar" id="btnRegistrar" type="submit" class="btn btn-primary mx-auto mb-5 d-flex rounded-pill bg-azul border-0 px-4"><div>Registrarme</div><div class="pl-5">></div></button>
            </form>

            <!-- Modal -->
            <div class="modal fade" id="miModal" name="miModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 2rem;">
                        <div class="modal-body">
                            <p class="modal-titular text-center">¡Gracias por suscribirte!</p>
                            <p class="modal-contenido text-center">en breve llegará un correo,<br>revisa tu bandeja de entrada;<br>en caso de no encontrarlo,<br>llegará a spam.</p>
                        </div>
                        <a href="https://m.facebook.com/story.php?story_fbid=193161222200777&id=109511293899104&sfnsn=mo" class="btn btn-secondary mx-auto mb-3 px-5 rounded-pill bg-celeste border-0" style="z-index: 100;">Aceptar</a>
                        <img src="img/fondo-modal.png" style="margin-top: -10%; border-radius: 2rem;" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s) {
                if (f.fbq) return; n=f.fbq=function() {
                    n.callMethod?
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)
                };
                if (!f._fbq)f._fbq=n;
                    n.push=n;
                    n.loaded=!0;n.version='2.0';
                    n.queue=[];
                    t=b.createElement(e);
                    t.async=!0;
                    t.src=v;
                    s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)
            } (window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '704179733746217');
            fbq('track', 'PageView');
        </script>







        
        <noscript>
            <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=704179733746217&ev=PageView&noscript=1" />
        </noscript>
        <!-- End Facebook Pixel Code -->

        
  <script>
    $(document).on('click', '#btnRegistrar', function(e){
    	e.preventDefault();
        var nombres = $('#nombres').val(), 
        correo = $('#correo').val(), 
    	    whatsapp = $('#whatsapp').val();
    
    	$.ajax({
    		url: 'registro.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
    		method: 'POST',
    		data: { nombres: nombres, whatsapp: whatsapp, correo: correo },
    		
    		success: function(r){
    			$("#miModal").modal("show");
    		}
    	});
    });
  </script>
    </body>
</html>