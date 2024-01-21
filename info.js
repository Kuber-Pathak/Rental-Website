//for navbar
window.addEventListener("scroll", function () {
  let header = document.querySelector("#navbar");
  header.classList.toggle("sticky", window.scrollY > 0);
});

//for dropdwon
let Dropdown = document.querySelector(".dropdown");
Dropdown.classList.toggle("hide");
let user = document.querySelector(".user-content");
document.querySelector(".left-side").addEventListener("click", () => {
  if (Dropdown.classList.contains("hide")) {
    Dropdown.classList.toggle("hide");
    user.style["boxShadow"] =
      "rgba(50, 50, 93, 0.25) 0px 8px 8px -4px, rgba(0, 0, 0, 0.3) 0px 4px 8px -8px";
  } else {
    user.style["boxShadow"] = "";
    Dropdown.classList.toggle("hide");
  }
});
//for latitude and lngitude
// var Location = "Balkumari";
// document.addEventListener(onload, findAddress());

function findAddress(Location) {
  var location = Location;
  var url =
    "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" +
    Location;
  fetch(url)
    .then((response) => response.json())
    .then((data) => (addressArr = data))
    .then((show) => setAddress())
    .catch((err) => console.log(err));
}

//for map
function setAddress() {
  const map = L.map("map");

  // Initializes map
  const lat = addressArr[0].lat;
  const lng = addressArr[0].lon;

  map.setView([lat, lng], 13);
  // Sets initial coordinates and zoom level

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: "© OpenStreetMap",
  }).addTo(map);
  // Sets map data source and associates with map

  let marker, circle;

  // navigator.geolocation.watchPosition(success, error);
  marker = L.marker([lat, lng]).addTo(map);
  // circle = L.circle([lat, lng], { radius: accuracy }).addTo(map);

  // function success(pos) {
  //   const lat = pos.coords.latitude;
  //   const lng = pos.coords.longitude;
  //   const accuracy = pos.coords.accuracy;

  //   if (marker) {
  //     map.removeLayer(marker);
  //     map.removeLayer(circle);
  //   }
  //   // Removes any existing marker and circule (new ones about to be set)

  //   marker = L.marker([lat, lng]).addTo(map);
  //   circle = L.circle([lat, lng], { radius: accuracy }).addTo(map);
  //   // Adds marker to the map and a circle for accuracy

  //   if (!zoomed) {
  //     zoomed = map.fitBounds(circle.getBounds());
  //   }
  //   // Set zoom to boundaries of accuracy circle

  //   map.setView([lat, lng]);
  //   // Set map focus to current user position
  // }

  // function error(err) {
  //   if (err.code === 1) {
  //     alert("Please allow geolocation access");
  //   } else {
  //     alert("Cannot get current location");
  //   }
  // }
}
//For confirmation
function showBookConfirmation() {
  return confirm("Are you sure you want to Book Now?");
}
function showMessageConfirmation() {
  return confirm("Are you sure you want to Send Message?");
}
