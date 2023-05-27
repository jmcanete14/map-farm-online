
var map = L.map('map').setView([14.1982572,120.8788768], 17);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);


// Example array of coordinates
const coordinates = [
    [14.19872008522572, 120.88206863803913],
    [14.199479362706317, 120.87910747950812],
    [14.196057393395686, 120.8821759263917],
    [14.196743871628177, 120.87965465010625],
    // Add more coordinates here...
  ];



let marker, circle;


//begin
render_to_map();


function render_to_map(){

        // remove existing marker and circles;
        if (marker) {
            map.removeLayer(marker);
            map.removeLayer(circle)
        }

        // Add circles for each coordinate in the array
        coordinates.forEach(coord => {
            L.marker(coord).addTo(map);
            L.circle(coord, { radius: 50 }).addTo(map); // Adjust the radius as needed
        });

        

        // Create a bounds object to fit all markers
        var bounds = new L.LatLngBounds(coordinates.concat([coordinates]));

        // Fit the map to the bounds
        //map.fitBounds(bounds);
}



function error(err){
     if (err.code === 1){
        alert("Please allow geolocation access.");
     }
     else{
        alert("Cannot get location.");
     }

}