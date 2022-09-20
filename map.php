<?php
$lonlat = $_GET['cordinates'];
list($latitude, $longitude) = explode("_", $lonlat);
$coordinates = 'new google.maps.LatLng(' . $latitude . ',' . $longitude . ')';
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mapStyle.css">
    <title>Transaction Point</title>
</head>

<body>
    <nav>

    </nav>

    <div class="outer-scontainer">
        <div class="row">
            <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="form-area">
                    <button type="submit" id="submit" name="import" class="btn-submit">RELOAD DATA</button><br />
                </div>
            </form>
        </div>

        <div id="map" style="width: 100%; height: 80vh;"></div>

        <script>
            function initMap() {
                var mapOptions = {
                    zoom: 18,
                    center: {<?php echo 'lat:' .  $latitude . ', lng:' . $longitude; ?>}, //{lat: --- , lng: ....}
                    mapTypeId: google.maps.MapTypeId.SATELITE
                };

                var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                mark = 'images/mark.png';
                startPoint = {<?php echo 'lat:' . $latitude . ', lng:' . $longitude; ?>};

                var marker = new google.maps.Marker({
                    position: startPoint,
                    map: map,
                    icon: mark,
                    title: "Start point!",
                    animation: google.maps.Animation.BOUNCE
                });
                RoutePath.setMap(map);
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        </script>

        <!--remenber to put your google map key-->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-dFHYjTqEVLndbN2gdvXsx09jfJHmNc8&callback=initMap"></script>

</body>

</html>