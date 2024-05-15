<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <meta charset="utf-8">

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQGHyFT4lIkOOjXAr9XtdLjpPOg3KN460&callback=uno&libraries=&v=weekly">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <title>Obtener coordenadas de un marcador </title>
    <style type="text/css">
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('logo.png') 50% 50% no-repeat #d87523;
            /*background: red;*/
            opacity: .8;
        }

        #right-panel {
            font-family: "Roboto", "sans-serif";
            line-height: 27px;
            padding-left: 10px;
        }

        #right-panel select,
        #right-panel input {
            font-size: 15px;

        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #mapruta {
            height: 100%;
            float: left;
            width: 70%;

        }

        #right-panel {
            margin: 20px;
            /*border-width: 2px;*/
            width: 20%;
            height: 400px;
            float: left;
            text-align: left;
            /*padding-top: 0;
            background: red;*/
        }

        #directions-panel {
            margin-top: 10px;
            background-color: #ffee77;
            padding: 10px;
            overflow: scroll;
            height: 174px;
            display: none;
        }

        #waypoints {
            display: none;
        }
    </style>
    <style>
        #map {
            width: 100%;
            height: 100%;
        }

        #mapuno {
            width: 100%;
            height: 100%;
        }

        #coords {
            /* width: 500px;*/
        }

        #coordsuno {
            /*width: 500px;*/
        }

        .largo {
            height: 500px;
        }

        .mapa {
            padding-left: 72px;
            height: 549px;
        }

        .mapauno {
            padding-right: 72px;
            height: 549px;
        }

        .modal-body {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1rem;
            height: 596px;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- The Modal -->

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ubicación</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <!--  <iframe src=""   ></iframe>-->
                        <div id="map" style="border:0" allowfullscreen></div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="myModaluno">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Destino</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <!--  <iframe src=""   ></iframe>-->
                        <div id="mapuno" style="border:0" allowfullscreen></div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <style>
        #obj3 {
            display: none;
        }



        #obj1 {
            display: none;
        }
    </style>
    <script>
        function ocultar() {
            var x = document.getElementById("obj1");
            var x2 = document.getElementById("obj2");

            if (x.style.display === "block") {
                x.style.display = "none";
                x2.style.display = "block";
                document.getElementById("btnubicacion").value = "buscar";
            } else {
                x.style.display = "block";
                x2.style.display = "none";
                document.getElementById("btnubicacion").value = "defecto";
            }
        }


        function ocultardos() {
            var x = document.getElementById("obj3");
            var x2 = document.getElementById("obj4");

            if (x.style.display === "block") {
                x.style.display = "none";
                x2.style.display = "block";
                document.getElementById("btndestino").value = "buscar";
            } else {
                x.style.display = "block";
                x2.style.display = "none";
                document.getElementById("btndestino").value = "defecto";
            }
        }
    </script>

    <div id="mapruta"></div>
    <div id="right-panel">
        <div>
            <b>Ubicación:</b>
            <input id="btnubicacion" type="button" value="buscar" onclick="ocultar()">

            <div id="obj1">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Ubicación</button>

            </div>
            <div id="obj2">
                <select id="start">
                    <option value="">Seleccionar</option>
                    <option value="Toparpa 250, La Victoria">Halifax, NS</option>
                    <option value="-6.789341347409061,-79.83423567564087">Boston, MA</option>
                    <option value="New York, NY">New York, NY</option>
                    <option value="Miami, FL">Miami, FL</option>
                </select>
            </div>
            <br />
            <!-- <b>Waypoints:</b> <br />
            <i>(Ctrl+Click or Cmd+Click for multiple selection)</i> <br />-->
            <select multiple id="waypoints">
                <option value="">Seleccionar</option>
                <option value="-6.773083, -79.839001">Montreal, QBC</option>
                <option value="-6.773083, -79.839001">Toronto, ONT</option>
                <option value="chicago, il">Chicago</option>
                <option value="winnipeg, mb">Winnipeg</option>
                <option value="fargo, nd">Fargo</option>
                <option value="calgary, ab">Calgary</option>
                <option value="spokane, wa">Spokane</option>
            </select>
            <br />
            <b>Destino:</b>
            <input id="btndestino" type="button" value="buscar" onclick="ocultardos()">

            <div id="obj3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModaluno">Destino</button>
            </div>
            <div id="obj4">
                <select id="end">
                    <option value="">Seleccionar</option>
                    <option value="-6.762416, -79.839295">Vancouver, BC</option>
                    <option value="-6.789341347409061,-79.83423567564087">Seattle, WA</option>
                    <option value="San Francisco, CA">San Francisco, CA</option>
                    <option value="Los Angeles, CA">Los Angeles, CA</option>
                </select></div>
            <br />
            <input type="submit" id="submit" />
        </div>
        <!--<a class="btn btn-primary btn-lg " href='javascript:;' onclick="pedirtaxi()" role="button">
         -->
        <div id="directions-panel"></div>
        <div>

            <form method="post" id="formdata" action="ws/ws_app.php">
                <label for="">idpasajero</label>
                <br>
                <input type="text" name="idpasajero" id="idpasajero" value="102">
                <br>
                <label for="">fotopasajero</label>
                <br>
                <input type="text" name="fotopasajero" id="fotopasajero" value="http://d30y9cdsu7xlg0.cloudfront.net/png/212">
                <br>
                <label for="">idusuario</label>
                <br>
                <input type="text" name="idusuario" id="idusuario" value="201">
                <br>
                <label for="">nombrepasajero</label>
                <br>
                <input type="text" name="nombrepasajero" id="nombrepasajero" value="HENRY MARCELINO DELGADO DE LA CRUZ">
                <br>
                <label for="">latdestino</label>
                <br>
                <input type="text" name="latdestino" id="latdestino">
                <br>
                <label for="">longdestino</label>
                <br>
                <input type="text" name="longdestino" id="longdestino">
                <br>
                <label for="">latorigen</label>
                <br>
                <input type="text" name="latorigen" id="latorigen">
                <br>
                <label for="">longorigen</label>
                <br>
                <input type="text" name="longorigen" id="longorigen">
                <br>
                <label for="">direccionorigen</label>
                <br>
                <input type="text" name="direccionorigen" id="inicio">
                <br>
                <label for="">direcciondestino</label>
                <br>
                <input type="text" name="direcciondestino" id="fin">
                <br>
                <label for="">referencia</label>
                <br>
                <input type="text" name="referencia" id="referencia" value="casa blanca">
                <br>
                <label for="">token_pasajero</label>
                <br>
                <input type="text" name="token_pasajero" id="token_pasajero" value="f6k6zvBcwfE:APA91bEVstlSqfhClmdz03GEH98NZrXrYy0TuH_82Tn7s5mVTzWMmPV7supRnFmm3lo4hkSiDcpvlUuzhG5Lu7ASthVoGuNJlghx2WfUIF5sX5JHIr-ypfZu4rYxazLThPdYfJfUbWGA">
                <br>
                <label for="">Accion</label>
                <br>
                <input type="text" name="accion" id="accion" value="PEDIR_TAXI">
                <br>
                <label for="">Boton pedir</label>
                <br>
                <input type="submit" value="PedirTaxi">
                <br>

                <input type="text" id="coords">
                <input type="text" id="coordsuno">
                <!-- <input type="text" id="inicio" /><br>
            <input type="text" id="fin" /><br>-->
                <input type="text" id="km"><br>
                <input type="text" id="tiempo">



                <input type="text" id="idsolicitud">
                <input type="text" id="correcto">
                <input type="text" id="error">
                <input type="text" id="codeError">

            </form>
            <div id="mensaje"></div>
           
            <button onclick="solicitud()">prueba</butto>



        </div>
        <button onclick="pedirtaxi()">Pedir taxijs</butto>
    </div>
    <script>
        function pedirtaxi() {
            var idpasajero = $('#idpasajero').val();
            var fotopasajero = $('#fotopasajero').val();
            var idusuario = $('#idusuario').val();
            var nombrepasajero = $('#nombrepasajero').val();
            var latdestino = $('#latdestino').val();
            var longdestino = $('#longdestino').val();
            var longorigen = $('#longorigen').val();
            var latorigen = $('#latorigen').val();
            var direccionorigen = $('#inicio').val();
            var direcciondestino = $('#fin').val();
            var referencia = $('#referencia').val();
            var token_pasajero = $('#token_pasajero').val();
            var accion = $('#accion').val();
            var div = document.getElementById('mensaje');
            $.ajax({
                url: "../vespro/ws/ws_app.php",
                method: "post",


                data: {
                    idpasajero: idpasajero,
                    fotopasajero: fotopasajero,
                    idusuario: idusuario,
                    nombrepasajero: nombrepasajero,
                    latdestino: latdestino,
                    longdestino: longdestino,
                    latorigen: latorigen,
                    longorigen: longorigen,
                    direccionorigen: direccionorigen,
                    direcciondestino: direcciondestino,
                    referencia: referencia,
                    token_pasajero: token_pasajero,
                    accion: accion,

                },
                dataType: 'json',
                beforeSend: function() {
                    $("#mensaje").html("<div class='loader'></div>")

                },
                /*timeout: 11000,*/

                success:

                    function(output) {
                        //console.log(output);


                        //
                        if (output.correcto == "false") {
                            $('#idsolicitud').val(output.idsolicitud);
                            $('#correcto').val(output.correcto);
                            $('#error').val(output.error);
                            $('#codeError').val(output.codeError);
                            div.style.display = 'none';

                        } else {
                            $('#idsolicitud').val(output.idsolicitud);
                            $('#correcto').val(output.correcto);
                            div.style.display = 'none';
                            /* $('#nombres').val(output.nombres);
                             $('#n').val(output.nombres);
                             $('#apellido').val(output.apellido_paterno + ' ' + output.apellido_materno);
                             $('#a').val(output.apellido_paterno + ' ' + output.apellido_materno);*/
                        }
                    }
            })

        }


        function mostrar(){
            
            
        }
        function solicitud() {
            var correcto = $('#correcto').val();
            if (condition) {
                
                setInterval( mostrar, 12000);




            } else {

            }



        }
    </script>


    <!--$(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
            $("#botonenviar").click(function() { // Con esto establecemos la acción por defecto de nuestro botón de enviar.


                

            });
        })<form id="formulario" method="Post">
                <input type="button" name="enviar" value="Enviar" onclick="recibir();"/><br>
                
                </form>
                <script language="javascript">     
        function recibir()
        {
            var valor = document.getElementById("inicio");
            document.getElementById("inicio").value=valor.textContent;   //imprime elementos html     
            var valor = document.getElementById("fin");
            document.getElementById("fin").value=valor.textContent;   //imprime elementos html
            var valor = document.getElementById("km");
            document.getElementById("km").value=valor.textContent;   //imprime elementos html
            var valor = document.getElementById("tiempo");
            document.getElementById("tiempo").value=valor.textContent;   //imprime elementos html
        }        
    </script> 
-->














    <script>
        uno = function() {
            initMap();
            initMapuno()
            initMapruta()
        }

        function initMapruta() {
            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();
            const mapruta = new google.maps.Map(document.getElementById("mapruta"), {
                zoom: 13,
                center: {
                    lat: -6.762416,
                    lng: -79.839295
                }
            });
            directionsRenderer.setMap(mapruta);
            document.getElementById("submit").addEventListener("click", () => {
                calculateAndDisplayRoute(directionsService, directionsRenderer);
            });
        }

        function calculateAndDisplayRoute(directionsService, directionsRenderer) {
            const waypts = [];
            const checkboxArray = document.getElementById("waypoints");

            for (let i = 0; i < checkboxArray.length; i++) {
                if (checkboxArray.options[i].selected) {
                    waypts.push({
                        location: checkboxArray[i].value,
                        stopover: true
                    });
                }
            }
            //ubicacion segun el control seleccionado
            var latorigen = document.getElementById("latorigen").value;
            var longorigen = document.getElementById("longorigen").value;
            ///////////
            var latdestino = document.getElementById("latdestino").value;
            var longdestino = document.getElementById("longdestino").value;
            //////////

            var partida = document.getElementById("btnubicacion").value;
            var start = "";
            var llegada = document.getElementById("btndestino").value;
            var final = "";
            if (partida == "buscar") {
                start = document.getElementById("start").value;
            } else {
                start = latorigen + "," + longorigen;
            }
            //Destino segun el control seleccionado


            if (llegada == "buscar") {

                final = document.getElementById("end").value;
            } else {
                final = latdestino + "," + longdestino;
            }
            directionsService.route({

                    // origin: document.getElementById("start").value,
                    //destination: document.getElementById("end").value,
                    //origin: document.getElementById("coords").value,
                    origin: start,
                    destination: final,
                    waypoints: waypts,
                    optimizeWaypoints: true,
                    travelMode: google.maps.TravelMode.DRIVING
                },
                (response, status) => {
                    if (status === "OK") {
                        directionsRenderer.setDirections(response);
                        const route = response.routes[0];
                        const summaryPanel = document.getElementById("directions-panel");
                        summaryPanel.innerHTML = ""; // Para cada ruta, muestre información resumida.
                        const inicio = document.getElementById("inicio");
                        inicio.innerHTML = ""; // Para cada ruta, muestre información resumida.
                        const fin = document.getElementById("fin");
                        fin.innerHTML = ""; // Para cada ruta, muestre información resumida.
                        const km = document.getElementById("km");
                        km.innerHTML = ""; // Para cada ruta, muestre información resumida.
                        const tiempo = document.getElementById("tiempo");
                        tiempo.innerHTML = ""; // Para cada ruta, muestre información resumida.

                        for (let i = 0; i < route.legs.length; i++) {
                            const routeSegment = i + 1;
                            /* inicio del panel
                            summaryPanel.innerHTML +="<b>Route Segment: " + routeSegment + "</b><br>";// titulo numero de RUTA
                            summaryPanel.innerHTML += route.legs[i].start_address + " to ";//inicio
                            summaryPanel.innerHTML += route.legs[i].end_address + "<br>";//fin
                            summaryPanel.innerHTML += route.legs[i].distance.text + "<br>";//distancia
                            summaryPanel.innerHTML += route.legs[i].duration.text + "<br><br>";//tiempo*/
                            //final del panel
                            //input
                            inicio.innerHTML += route.legs[i].start_address; //crea un elemento html
                            fin.innerHTML += route.legs[i].end_address;
                            km.innerHTML += route.legs[i].distance.text;
                            tiempo.innerHTML += route.legs[i].duration.text;

                            var valor = document.getElementById("inicio");
                            document.getElementById("inicio").value = valor
                                .textContent; //imprime elementos html     
                            var valor = document.getElementById("fin");
                            document.getElementById("fin").value = valor.textContent; //imprime elementos html
                            var valor = document.getElementById("km");
                            document.getElementById("km").value = valor.textContent; //imprime elementos html
                            var valor = document.getElementById("tiempo");
                            document.getElementById("tiempo").value = valor.textContent; //imprime elementos html







                        }

                    } else {
                        window.alert("Solicitud de direcciones a fallado debido a que no a seleccionado una ruta");
                        //window.alert("Solicitud de direcciones fallida debido a " + status);
                    }
                }
            );
        }
















        var marker; //variable del marcador
        var coords = {}; //coordenadas obtenidas con la geolocalización
        var markeruno; //variable del marcador
        var coordsuno = {}; //coordenadas obtenidas con la geolocalización
        //Funcion principal
        initMap = function(position) {


                coords = {
                    // lng: position.coords.longitude,
                    //lat: position.coords.latitude
                    lat: -6.762416,
                    lng: -79.839295
                };
                setMapa(coords); //pasamos las coordenadas al metodo para crear el mapa


            },
            function(error) {
                console.log(error);
            }
        initMapuno = function(position) {

                coordsuno = {
                    lat: -6.762416,
                    lng: -79.839295
                    //lng: position.coords.longitude,
                    //lat: position.coords.latitude
                };
                setMapauno(coordsuno); //pasamos las coordenadas al metodo para crear el mapa
            },
            function(error) {
                console.log(error);
            };


        function setMapa(coords) {
            //Se crea una nueva instancia del objeto mapa
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: new google.maps.LatLng(coords.lat, coords.lng),
            });
            //Creamos el marcador en el mapa con sus propiedades
            //para nuestro obetivo tenemos que poner el atributo draggable en true
            //position pondremos las mismas coordenas que obtuvimos en la geolocalización
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(coords.lat, coords.lng),
            });
            //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
            //cuando el usuario a soltado el marcador
            marker.addListener('click', toggleBounce);
            marker.addListener('dragend', function(event) {
                //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                document.getElementById("latorigen").value = this.getPosition().lat();
                document.getElementById("longorigen").value = this.getPosition().lng();
                //document.getElementById("coords").value = this.getPosition().lat() + "," + this.getPosition().lng();
            });
        }

        function setMapauno(coordsuno) {
            //Se crea una nueva instancia del objeto mapa
            var map = new google.maps.Map(document.getElementById('mapuno'), {
                zoom: 13,
                center: new google.maps.LatLng(coordsuno.lat, coordsuno.lng),
            });
            //Creamos el marcador en el mapa con sus propiedades
            //para nuestro obetivo tenemos que poner el atributo draggable en true
            //position pondremos las mismas coordenas que obtuvimos en la geolocalización
            markeruno = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(coordsuno.lat, coordsuno.lng),
            });
            //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
            //cuando el usuario a soltado el marcador
            markeruno.addListener('click', toggleBounceuno);
            markeruno.addListener('dragend', function(event) {
                //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                document.getElementById("latdestino").value = this.getPosition().lat();
                document.getElementById("longdestino").value = this.getPosition().lng();

                //document.getElementById("coordsuno").value = this.getPosition().lat() + "," + this.getPosition().lng();
            });
        }


        //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
        function toggleBounce() {
            if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }


        //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
        function toggleBounceuno() {
            if (markeruno.getAnimation() !== null) {
                markeruno.setAnimation(null);
            } else {
                markeruno.setAnimation(google.maps.Animation.BOUNCE);
            }
        }


        // Carga de la libreria de google maps 
    </script>

    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>