<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
        <?php
        /* $conn = mysql_connect("localhost", "inton634_mapa", "ufrs3753") or die(mysql_error());
        mysql_select_db("inton634_mapas") or die(mysql_error());
        echo "conectou"; die; */
        ?>
        Google Maps
    </title>

    <style type="text/css">
        html { height: 100% }
        body { height: 100%; margin: 0; padding: 0 }
        #map { height: 100% }
    </style>

    <script src="https://maps.google.com/maps/api/js?key=X&sensor=false" type="text/javascript"></script>
    <script type="text/javascript">
        //Sample code written by August Li
        var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
            new google.maps.Size(32, 32), new google.maps.Point(0, 0),
            new google.maps.Point(16, 32));
        var center = null;
        var map = null;
        var currentPopup;
        var bounds = new google.maps.LatLngBounds();
        function addMarker(lat, lng, info, ico) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                position: pt,
                icon: new google.maps.MarkerImage('http://tele-tudo.com/resources/assets/img/mapas/' + ico),
                map: map
            });

            // icon: new google.maps.MarkerImage('icones/' + ico),
            // icon: icon,
            // http://intonses.com.br/public_html/teletudo/public_html/clientes/icones/ferragem.jpg
            // icon: new google.maps.MarkerImage('http://intonses.com.br/public_html/teletudo/public_html/clientes/icones/ferragem.jpg'),

            var popup = new google.maps.InfoWindow({
                content: info,
                maxWidth: 300
            });
            google.maps.event.addListener(marker, "click", function() {
                if (currentPopup != null) {
                    currentPopup.close();
                    currentPopup = null;
                }
                popup.open(map, marker);
                currentPopup = popup;
            });
            google.maps.event.addListener(popup, "closeclick", function() {
                map.panTo(center);
                currentPopup = null;
            });
        }
        function initMap() {

            map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(-30.1472952717507, -51.15080416202545),
                zoom: 14,
                // mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                },
                navigationControl: true,
                navigationControlOptions: {
                    style: google.maps.NavigationControlStyle.ZOOM_PAN
                }
            });

            <?php
            $sql = 'SELECT MpaFrutas.ID, MpaTpofrutas.Nome, MpaFrutas.Location, MpaTpofrutas.Imagen
                    FROM MpaFrutas
                    INNER JOIN MpaTpofrutas ON MpaFrutas.IDFruta = MpaTpofrutas.ID';
            $results = DB::select(DB::raw($sql));
            foreach ($results as $reg) {
                $lats = explode(",", $reg->Location);
                if (count($lats)==2) {
                    $lat = $lats[0];
                    $lon = $lats[1];
                    $name = $reg->Nome;
                    $ico = $reg->Imagen;
                    echo("addMarker($lat, $lon, '<b>$name</b><br />', '".$ico."');\n");
                }
            }
            ?>
            center = bounds.getCenter();
            map.fitBounds(bounds);
        }
    </script>
</head>
<body onload="initMap()" style="margin:0px; border:0px; padding:0px;">
{{--Click <a href="https://tele-tudo.com/public/novafruta">AQUI</a> para adicionar um pé de fruta--}}
<div id="map"></div>
</body>
</html>
