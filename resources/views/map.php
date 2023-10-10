
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- HTML -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8NHCF-5fMix0w2363RhC3V4vcyw8SHSM&callback=initMap" async defer></script>


</head>
<body>
    <!-- HTML -->
<div style="height: 900px;" id="map"></div>

<input type="text" id="latitudeInput">
<input type="text" id="longitudeInput">

<script>
    // JavaScript
    // function initMap() {
    //     var map = new google.maps.Map(document.getElementById('map'), {
    //         center: { lat: 40.374912941735026, lng: 71.7851208729229 }, // Ishlatilayotgan boshlang'ich markaziy koordinatalar 40.374912941735026, 71.7851208729229
    //         zoom: 16 // Ishlatilayotgan boshlang'ich zoom darajasi
    //     });

        // Kerakli boshqa funktsiyalarni yozing...
    // }


    var map;
    var marker;
    var latitudeInput = document.getElementById('latitudeInput');
    var longitudeInput = document.getElementById('longitudeInput');

    function initMap() {
        var defaultLocation = { lat: 0, lng: 0 };
        map = new google.maps.Map(document.getElementById('map'), {
            center: defaultLocation,
            zoom: 8
        });

        map.addListener('click', function(event) {
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();

            latitudeInput.value = latitude;
            longitudeInput.value = longitude;

            if (marker) {
                marker.setMap(null); // Eski marker ni o'chirish
            }

            marker = new google.maps.Marker({
                position: event.latLng,
                map: map,
                draggable: true
            });
        });
    }

</script>
</body>
</html>