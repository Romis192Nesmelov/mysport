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
    },{
        suppressMapOpenBlock: true
    });
    processingPoints(myMap, window.points);

    myMap.geoObjects.events.add('click', function (e) {
        var data = e.get('target').properties._data;
        window.location.href = '/' + data.baseType + '?id=' + data.baseId;
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
    $.each(collectionPoints, function (type,points) {
        if (points && points.length) {
            var icon = ymaps.templateLayoutFactory.createClass('<div class="map-point '+type+'"></div>');
            for (var i=0;i<points.length;i++) {
                addingPoints(myMap, [points[i].latitude,points[i].longitude], type, points[i].id, points[i]['name_'+window.locale], points[i]['address_'+window.locale], icon);
            }
        }
    });
}

function addingPoints(myMap, coordinates, type, id, name, address, icon) {
    var place = new ymaps.Placemark(coordinates,{
            hintContent: '<div class="point-hit">' +
                            '<div class="description">' + window.nameScript + '</div>' +
                            '<div class="credential">' + name + '</div>' +
                            '<div class="description">' + window.addressScript + '</div>' +
                            '<div class="credential">' + address + '</div>' +
                            '<div class="description">' + window.coordinatesScript + '</div>' +
                            '<div class="credential">' + coordinates[0] + ',' + coordinates[1] + '</div>' +
                        '</div>',
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
    myMap.geoObjects.add(place);
}