$(window).on('load', function () {
    initGmap();
});

function initGmap() {
    var gmarkers = [];
    var styles = [{
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [{
                    "color": "#cacaca"
                }, {
                    "lightness": 17
                }]
        }, {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [{
                    "color": "#f5f5f5"
                }, {
                    "lightness": 20
                }]
        }, {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 17
                }]
        }, {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 29
                }, {
                    "weight": 0.2
                }]
        }, {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 18
                }]
        }, {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 16
                }]
        }, {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [{
                    "color": "#f5f5f5"
                }, {
                    "lightness": 21
                }]
        }, {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [{
                    "color": "#dedede"
                }, {
                    "lightness": 21
                }]
        }, {
            "elementType": "labels.text.stroke",
            "stylers": [{
                    "visibility": "on"
                }, {
                    "color": "#ffffff"
                }, {
                    "lightness": 16
                }]
        }, {
            "elementType": "labels.text.fill",
            "stylers": [{
                    "saturation": 36
                }, {
                    "color": "#333333"
                }, {
                    "lightness": 40
                }]
        }, {
            "elementType": "labels.icon",
            "stylers": [{
                    "visibility": "off"
                }]
        }, {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [{
                    "color": "#f2f2f2"
                }, {
                    "lightness": 19
                }]
        }, {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [{
                    "color": "#fefefe"
                }, {
                    "lightness": 20
                }]
        }, {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [{
                    "color": "#fefefe"
                }, {
                    "lightness": 17
                }, {
                    "weight": 1.2
                }]
        }]
    var marker;
    var mapCanvas = document.getElementById('map-canvas');
    var infowindow = new google.maps.InfoWindow();
    var bounds = new google.maps.LatLngBounds();
    var draggable = true;
    var mapOptions = {
        scrollwheel: false,
        draggable: draggable,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: styles,
        center: {lat: 50.5475528, lng: 30.2298945},
        zoom: 16,
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);
    for (var i = 0; i < markers.length; i++) {
        addMarkers(markers[i]);
    }

    function addMarkers(marker) {
        var content = marker[0];
        var icon = marker[1];
        var category = marker[2];
        var position = new google.maps.LatLng(marker[3], marker[4]);

        marker = new google.maps.Marker({
            position: position,
            icon: icon,
            category: category,
            map: map
        });

        gmarkers.push(marker);
        bounds.extend(marker.position);
        map.fitBounds(bounds);

        google.maps.event.addListener(marker, 'click', (function (marker, content) {
            return function () {
                infowindow.setContent(content);
                infowindow.open(map, marker);
            }
        })(marker, content));
    }

    filterMarkers = function (category) {
        for (i = 2; i < markers.length; i++) {
            marker = gmarkers[i];
            if (marker.category == category || category.length === 0) {
                marker.setVisible(true);
            } else {
                marker.setVisible(false);
            }
        }
    }

    resetMarkers = function () {
        for (i = 2; i < markers.length; i++) {
            gmarkers[i].setVisible(true);
        }
    }

}
;