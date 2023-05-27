
var map = L.map('map').setView([14.1982572,120.8788768], 17);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);




// do something else with the selected value
function fetchData() {
    $.ajax({
        url:'ajax.php?action=get_object_data',
        method:'POST',
        success:function(resp){
            arr = get_objects_data(resp); 
            render_to_map(arr);
        }
        
    });
}

function get_objects_data(resp){
    coordinates = [];

    var responseObject = JSON.parse(resp);
    var arrayCount = Object.keys(responseObject).length;

    // add the new option element with the value attribute using innerHTML
    for (var i = 0; i < arrayCount; i++) {
        
        coordinates.push([responseObject[i]['latitude'], responseObject[i]['longitude']]);
        
    }

    return coordinates
}





let marker=[], circle=[];

function render_to_map(coordinates){

        // remove existing marker and circles;
        if (marker.length > 0) {
            for(i=0; i<marker.length; i++){
                map.removeLayer(marker[i]);
                map.removeLayer(circle[i]);
            }
        }

        // Add circles for each coordinate in the array
        coordinates.forEach(coord => {
            mrk = L.marker(coord).addTo(map);
            ckl = L.circle(coord, { radius: 50 }).addTo(map); // Adjust the radius as needed

            marker.push(mrk);
            circle.push(ckl);
        });

        

        // Create a bounds object to fit all markers
        var bounds = new L.LatLngBounds(coordinates.concat([coordinates]));

        // Fit the map to the bounds
        //map.fitBounds(bounds);

        
}



// Call fetchData function immediately
fetchData();

// Re-run fetchData function every 5 seconds (5000 milliseconds)
setInterval(fetchData, 5000);