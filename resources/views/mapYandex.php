<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- HTML -->
    <script src="https://api-maps.yandex.ru/2.1/?apikey=4ee30b78-bb09-45b8-a270-fb4efb6d8880&lang=uz_UZ" type="text/javascript"></script>

</head>
<body>
    
    <!-- HTML -->
<div id="map" style="width: 100%; height: 500px;"></div>
<input type="text" id="latitudeInput">
<input type="text" id="longitudeInput">
<input type="text" id="addressInput">


<script>

    ymaps.ready(function () {
        var map = new ymaps.Map('map', {
            center: [41.2995, 69.2401], // Ishlatilayotgan boshlang'ich markaziy koordinatalar
            zoom: 10 // Ishlatilayotgan boshlang'ich zoom darajasi
        });

        // Foydalanuvchi turish joyini aniqlash
        ymaps.geolocation.get().then(function (res) {
            var userLocation = res.geoObjects.get(0).geometry.getCoordinates();
            map.setCenter(userLocation);

            // Foydalanuvchi turish joyiga marker qo'shish
            var userPlacemark = new ymaps.Placemark(userLocation, {}, { preset: 'islands#blueCircleDotIcon' });
            map.geoObjects.add(userPlacemark);
        });
            

        var placemark;
        map.events.add('click', function (e) {
            var coords = e.get('coords');

            // Kursor yordamida belgilangan joyga qizil belgi qo'yish
            if (placemark) {
                map.geoObjects.remove(placemark);
            }
            placemark = new ymaps.Placemark(coords, {}, { preset: 'islands#redIcon' });
            map.geoObjects.add(placemark);

            // Kordinatalarni input elementlarga joylash
            var latitudeInput = document.getElementById('latitudeInput');
            var longitudeInput = document.getElementById('longitudeInput');
            latitudeInput.value = coords[0].toPrecision(6);
            longitudeInput.value = coords[1].toPrecision(6);

            // Manzilni input elementga joylash
            ymaps.geocode(coords).then(function (res) {
                var address = res.geoObjects.get(0) ? res.geoObjects.get(0).getAddressLine() : '';
                var addressInput = document.getElementById('addressInput');
                addressInput.value = address;
            });
        });
    });

</script>

</body>
</html>