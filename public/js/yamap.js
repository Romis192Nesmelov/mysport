$(document).ready(function ($) {
    if ($('#map').length) {
        ymaps.ready(init);
    }
});

function init() {
    var myMap = new ymaps.Map('map', {
        center: [59.941627, 30.317027],
        zoom: 10,
        controls: []
    });
    processingPoints(myMap, window.points);

    myMap.geoObjects.events.add('click', function (e) {
        console.log(e.get('target').properties._data.baseId);
    });

    $('#exec-find').click(function () {
        myMap.geoObjects.removeAll();
        $.post('/find-points', {
            '_token':       $('input[name=_token]').val(),
            'area_id':      $('select[name=area]').val(),
            'kind_of_sport':$('select[name=kind_of_sport]').val(),
            'events':       $('input[name=events]').val(),
            'organizations':$('input[name=organizations]').val(),
            'sections':     $('input[name=sections]').val(),
            'places':       $('input[name=places]').val()
        }, function (data) {
            if (data.success) {
                processingPoints(myMap, data.points);
            }
        });
    });
}

function processingPoints(myMap, collectionPoints) {
    $.each(collectionPoints, function (k1,points) {
        if (points && points.length) {
            var icon = ymaps.templateLayoutFactory.createClass('<div class="map-point '+k1+'"></div>');
            for (var i=0;i<points.length;i++) {
                addingPoints(myMap, [points[i].latitude,points[i].longitude], k1, points[i].id, icon);
            }
        }
    });
}

function addingPoints(myMap, coordinates, type, id, icon) {
    var place = new ymaps.Placemark(coordinates,{
            // hintContent: points[i].id
            baseType: type,
            baseId: id
        },{
            iconLayout: icon,
            iconShape: {
                // type: 'Rectangle',
                // coordinates: [
                //     [-30, -30], [30, 30]
                // ]
                type: 'Circle',
                coordinates: [0, 0],
                radius: 35
            }
        }
    );
    // place.events.add('click', function (e) {
    //     console.log(e.get('coordPosition'));
    // });
    myMap.geoObjects.add(place);
}