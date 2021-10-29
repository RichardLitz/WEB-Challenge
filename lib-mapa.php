<?php
############################################## QUANDO FOR ROTA ###########################################################
############################################## QUANDO FOR ROTA ###########################################################
############################################## QUANDO FOR ROTA ###########################################################
if (trim($ArrayPosicaoRota) != "")
{
    #echo "ROTA:".$ArrayPosicaoRota;
    ?>
    <script type="text/javascript">
        // ULTIMAS POSIÇÕES ///
        var TripMarkersActual = [<?php echo substr(trim($ArrayPosicaoRota),0,-1); ?>];

        /*var TripMarkersActual = [
            ['', 33.604470, -112.078700, 0, '', '', '', ''],
            ['', 35.128250, -114.572300, 0, '', '', '', ''],
            ['', 36.110430, -115.060600, 0, '', '', '', ''],
            ['', 38.070300, -117.211100, 0, '', '', '', ''],
            ['', 39.4161922, -119.224832, 0, '', '', '', ''],
            ['', 39.117300, -119.773540, 0, '', '', '', ''],
            ['', 42.215280, -121.746800, 0, '', '', '', '']
        ];*/

        // PLANO DE VIAGEM ///
        /*var TripMarkersPlan = [
            ['Klamath Falls OR', 42.215280, -121.746800, 5, 'stop', 'red', '<div class="infwdw"><div class="infwdwTitle">Klamath Falls KOA</div>3435 Shasta Way<br/>Klamath Falls OR 97603<br/>42.215280/-121.746800</div>', ''],
            ['Bend OR', 44.030080, -121.311400, 7, 'stop', 'green', '(to be determined)', ''],
            ['Salem OR', 44.910980, -122.935100, 8, 'stop', 'yellow', '(to be determined)', ''],
            ['Portland OR', 45.340200, -122.558600, 9, 'stop', 'pink', '(to be determined)', '']
        ];*/

        var map;
        // set up directions system
        var directionDisplayActual;
        var rendererOptionsActual = {
            suppressMarkers: true
        };
        var polylineOptionsActual = {
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 4
        };
        var directionsServiceActual = new google.maps.DirectionsService();
        var directionDisplayPlan;
        var rendererOptionsPlan = {
            suppressMarkers: true
        };
        var polylineOptionsPlan = {
            strokeColor: '#00FF00',
            strokeOpacity: 1.0,
            strokeWeight: 5
        };

        function initialize() {
             //alert("initialize");
            var directionsServicePlan = new google.maps.DirectionsService();

            // create map definition
            var mapDiv = document.getElementById('map-canvas');
            map = new google.maps.Map(mapDiv, {
                center: new google.maps.LatLng(<?php echo $PrimeiraPosicaoRota; ?>),
                zoom: 12,
                icon: '<?php echo $_SESSION["s_Patch"]; ?>/assets/images/maps-marcador.png',
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: false
            });

            // Close infowindow when click on map
            google.maps.event.addListener(map, 'click', function () {
                infowindow.close();
            });

            // Draw the markers
            setMarkers(map, TripMarkersActual);


            //////////////////////////////////////////// PLANO DE VIAGEM //////////////////////////////////
            //setMarkers(map, TripMarkersPlan);

            // Draw the Plan path
           /* var spotPlace = TripMarkersPlan[0];
            var pathStart = new google.maps.LatLng(spotPlace[1], spotPlace[2]);
            var waypts = [];
            /*for (var i = 1; i < TripMarkersPlan.length - 2; i++) {
                var spotPlace = TripMarkersPlan[i];
                var latLng = new google.maps.LatLng(spotPlace[1], spotPlace[2]);
                waypts.push({
                    location: latLng,
                    stopover: true
                });
            } */// for
            /*var spotPlace = TripMarkersPlan[TripMarkersPlan.length - 1];
            var pathEnd = new google.maps.LatLng(spotPlace[1], spotPlace[2]);
            var request = {
                origin: pathStart,
                destination: pathEnd,
                waypoints: waypts,
                optimizeWaypoints: false,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
            // alert("request plan:"+pathStart+","+pathEnd+","+waypts.length);
            /*directionsServicePlan.route(request, function (response, status)
            {
                if (status == google.maps.DirectionsStatus.OK)
                {
                    //directionsDisplayPlan = new google.maps.DirectionsRenderer(rendererOptionsPlan);
                    // alert("directionsServicePlan callback:"+status);
                    directionsDisplayPlan = new google.maps.DirectionsRenderer({
                        suppressMarkers: true,
                        polylineOptions: polylineOptionsPlan
                    });
                    directionsDisplayPlan.setMap(map);
                    directionsDisplayPlan.setDirections(response);
                } // if
            }); // directionsServicePlan*/

            ////////////////////////////////////////////////////////////////////////////

            // Draw the Actual path
            var spotPlace = TripMarkersActual[0];
            var pathStart = new google.maps.LatLng(spotPlace[1], spotPlace[2]);
            var waypts = [];
            for (var i = 1; i < TripMarkersActual.length - 2; i++) {
                var spotPlace = TripMarkersActual[i];
                var latLng = new google.maps.LatLng(spotPlace[1], spotPlace[2]);
                waypts.push({
                    location: latLng,
                    stopover: true
                });
            } // for
            var spotPlace = TripMarkersActual[TripMarkersActual.length - 1];
            var pathEnd = new google.maps.LatLng(spotPlace[1], spotPlace[2]);
            var request = {
                origin: pathStart,
                destination: pathEnd,
                waypoints: waypts,
                optimizeWaypoints: false,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
             //alert("request actual:"+pathStart+","+pathEnd+","+waypts.length);
            directionsServiceActual.route(request, function (response, status)
            {
                if (status == google.maps.DirectionsStatus.OK) {
                // alert("directionsServiceActual callback:"+status);
                    directionsDisplayActual = new google.maps.DirectionsRenderer({
                        suppressMarkers: true,
                        polylineOptions: polylineOptionsActual
                    });
                //directionsDisplayActual = new google.maps.DirectionsRenderer(rendererOptionsActual);
                    directionsDisplayActual.setMap(map);
                    directionsDisplayActual.setDirections(response);
                } // if
            }); // directionsServiceActual

        } // initialize infowindow
        var infowindow = new google.maps.InfoWindow({
            maxWidth: 250
        });

        // function to setup markers
        function setMarkers(map, locations)
        {
            //alert('passso');
            var shadow = new google.maps.MarkerImage('<?php echo $_SESSION["s_Patch"]; ?>/assets/images/maps-marcador.png',
                new google.maps.Size(41, 27),
                new google.maps.Point(0, 0),
                new google.maps.Point(13, 27)
            );

            //alert("processing "+locations.length+" locations");
            for (var i = 0; i < locations.length; i++)
            {
                var spotPlace = locations[i];
                //alert("locations["+i+"]="+spotPlace);
                var isStop = spotPlace[4];
                if (isStop == 'stop')
                {
                    var latLng = new google.maps.LatLng(spotPlace[1], spotPlace[2]);
                    var markerNbr = spotPlace[3];
                    var markerColor = spotPlace[5];
                    var markerTitle = spotPlace[0];
                    var image = new google.maps.MarkerImage('<?php echo $_SESSION["s_Patch"]; ?>/assets/images/maps-marcador.png',
                        new google.maps.Size(57, 57),
                        new google.maps.Point(0, 0),
                        new google.maps.Point(28, 57)
                    );
                    var infoContent = spotPlace[6];
                    createMarker(latLng, map, image, shadow, markerTitle, infoContent);
                };
            } // for
        } // setMarkers

        // function to create markers
        function createMarker(latLng, map, image, shadow, markerTitle, infoContent)
        {
            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                icon: image,
                shadow: shadow,
                title: markerTitle
            });
            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(infoContent);
                infowindow.open(map, marker);
            });
        } // createMarker

        // function to trim chars from left
        function Right(str, n)
        {
            if (n <= 0)
                return "";
            else if (n > String(str).length)
                return str;
            else {
                var iLen = String(str).length;
                return String(str).substring(iLen, iLen - n);
            }
        } // Right

        google.maps.event.addDomListener(window, 'load', initialize);
        //initialize();
    </script>
    <?php
}
################################################### QUANDO FOR A ÚLTIMA POSIÇÃO ##################################################
################################################### QUANDO FOR A ÚLTIMA POSIÇÃO ##################################################
################################################### QUANDO FOR A ÚLTIMA POSIÇÃO ##################################################

else if(trim($_SESSION["s_PrimeiraPosicao"]) != "")
{
    #echo "passou ".$_SESSION["s_PrimeiraPosicao"];
    ?>
    <script async>
        var map;
        var infoWindow;

        // A variável markersData guarda a informação necessária a cada marcador
        // Para utilizar este código basta alterar a informação contida nesta variável
        var markersData = [ <?php echo substr(trim($_SESSION["s_ArrayPosicao"]), 0, -1); ?> ];

        function initialize()
        {
            var mapOptions = {
                center: new google.maps.LatLng(<?php echo $_SESSION["s_PrimeiraPosicao"]; ?>),
                zoom: 6,
                mapTypeId: 'roadmap',
                icon: '<?php echo $_SESSION["s_Patch"]; ?>/assets/images/maps-marcador.png',
                disableDefaultUI: false
            };

            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            /* ADICIONANDO ELEMENTOS HTML NO MAPA */
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('f_CdVeiculoMapa'));
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(document.getElementById('idHistoricoPosicao'));


            // cria a nova Info Window com referência à variável infowindow
            // o conteúdo da Info Window será atribuído mais tarde
            infoWindow = new google.maps.InfoWindow({maxWidth: 400});

            // evento que fecha a infoWindow com click no mapa
            google.maps.event.addListener(map, 'click', function () {
                infoWindow.close();
            });

            // Chamada para a função que vai percorrer a informação
            // contida na variável markersData e criar os marcadores a mostrar no mapa
            displayMarkers();
        }


        // Esta função vai percorrer a informação contida na variável markersData
        // e cria os marcadores através da função createMarker
        function displayMarkers()
        {
            // esta variável vai definir a área de mapa a abranger e o nível do zoom
            // de acordo com as posições dos marcadores
            var bounds = 9;

            // Loop que vai estruturar a informação contida em markersData
            // para que a função createMarker possa criar os marcadores
            for (var i = 0; i < markersData.length; i++) {

                var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
                var placa = markersData[i].placa;
                var frota = markersData[i].frota;
                var marca = markersData[i].marca;
                var modelo = markersData[i].modelo;
                var velocidade = markersData[i].velocidade;
                var nr_equipamento = markersData[i].nr_equipamento;
                var endereco = markersData[i].endereco;

                createMarker(latlng, placa, frota, marca, modelo, velocidade, nr_equipamento,endereco);

                // Os valores de latitude e longitude do marcador são adicionados à
                // variável bounds
                //bounds.extend(latlng);
            }

            // Depois de criados todos os marcadores
            // a API através da sua função fitBounds vai redefinir o nível do zoom
            // e consequentemente a área do mapa abrangida.
            map.fitBounds(bounds);
        }

        // Função que cria os marcadores e define o conteúdo de cada Info Window.
        function createMarker(latlng, placa, frota, marca, modelo, velocidade, nr_equipamento,endereco)
        {
            var marker = new google.maps.Marker({
                map: map,
                position: latlng,
                title: placa,
                icon: '<?php echo $_SESSION["s_Patch"]; ?>/assets/images/maps-marcador.png',
                zoom: 6,
                disableDefaultUI: false
            });



            // Evento que dá instrução à API para estar alerta ao click no marcador.
            // Define o conteúdo e abre a Info Window.


            google.maps.event.addListener(marker, 'click', function () {
                var iwContent = '';
                // Variável que define a estrutura do HTML a inserir na Info Window.
                if((nr_equipamento != "") && (nr_equipamento != undefined))
                {
                    iwContent = '<div id="iw_container">' +
                        '<div class="iw_title"><strong>PLACA:</strong> ' + placa + '</div>' +
                        velocidade + '<br><strong>ENDEREÇO:</strong> ' +
                        endereco + '</div><br>' +
                        '<div class="iw_title" align="center">' +
                        '<a class="btn btn-default waves-effect waves-light" target="_blank" href="<?php echo $_SESSION["s_Patch"]; ?>/modulos/<?php echo $_SESSION["s_TipoAplic"]; ?>/<?php echo $_SESSION["s_PastaAplic"]; ?>/<?php echo trim($_SESSION["s_ArqImprimir"]); ?>?CdBusca=' + nr_equipamento + '"><span class="btn-label"><i class="fa fa-exclamation"></i></span>Rota</a></div>' +
                        '</div>';
                }

                // O conteúdo da variável iwContent é inserido na Info Window.
                infoWindow.setContent(iwContent);
                // A Info Window é aberta.
                infoWindow.open(map, marker);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        //initialize();
    </script>
    <?php
}
    ?>

