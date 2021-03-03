var map;
var geocoder;

function loadMap() {
    var marseille = {lat: 43.403323, lng: 5.353720};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: marseille
    });

    // var marker = new google.maps.Marker({
    //     position: marseille,
    //     map: map
    // });

    var cdata = JSON.parse(document.getElementById('data').innerHTML);
    geocoder = new google.maps.Geocoder();
    codeAddress(cdata);

    var allData = JSON.parse(document.getElementById('allData').innerHTML);
    showAllShop(allData)
}


function showAllShop(allData) {
    var infoWind = new google.maps.InfoWindow;
    Array.prototype.forEach.call(allData, function(data){
        var content = document.createElement('div');
        var strong = document.createElement('strong');

        strong.textContent = data.name;
        content.appendChild(strong);


        var img = document.createElement('img');
        img.src = '../img/logo.png';
        img.style.width = '70px';
        content.appendChild(img);

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(data.lat, data.lng),
            map: map
        });

        marker.addListener('mouseover', function(){
            infoWind.setContent(content);
            infoWind.open(map, marker);
        })
    })
}

function codeAddress(cdata) {
    Array.prototype.forEach.call(cdata, function (data) {
        var address = data.name + ' ' + data.address;
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                var points = {};
                points.id = data.id;
                points.lat = map.getCenter().lat();
                points.lng = map.getCenter().lng();
                updateShopWithLatLng(points);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    });
}

function updateShopWithLatLng(points) {
    $.ajax({
        url: "../class/action.php",
        method: "post",
        data: points,
        success: function (res) {
            console.log(res)
        }
    })

}
