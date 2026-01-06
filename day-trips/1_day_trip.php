<?php
$conn = new mysqli("localhost", "root", "Root123!@#", "discoverly");

$placeIDs = [1, 2, 4, 7, 8, 9, 10, 13]; 

$placeholders = implode(',', array_fill(0, count($placeIDs), '?'));
$sql = "SELECT placeID, name, latitude, longitude FROM Place WHERE placeID IN ($placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat('i', count($placeIDs)), ...$placeIDs);
$stmt->execute();
$places = $stmt->get_result();

$coordinates = [];
while ($row = $places->fetch_assoc()) {
    $coordinates[] = [
        'name' => $row['name'],
        'lat' => $row['latitude'],
        'lng' => $row['longitude']
    ];
}

$activitySql = "SELECT name, latitude, longitude FROM Activity WHERE activityID = 1";
$activityResult = $conn->query($activitySql);
$activity = $activityResult->fetch_assoc();
if ($activity) {
    $coordinates[] = [
        'name' => $activity['name'],
        'lat' => $activity['latitude'],
        'lng' => $activity['longitude']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>1-Day Trip - Discoverly</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
:root {
--bg-color: #f9f6f1;
--text-color: #2d2d2d;
--accent-color: #1e3a5f;
--card-bg: #ffffff;
}
* {
margin: 0;
padding: 0;
box-sizing: border-box;
}
body {
font-family: "Inter", sans-serif;
background-color: var(--bg-color);
color: var(--text-color);
line-height: 1.6;
}
header {
display: flex;
justify-content: space-between;
align-items: center;
padding: 1.5rem 4rem;
}
header h1 {
font-size: 1.5rem;
font-weight: 700;
color: var(--accent-color);
}
nav a {
margin-left: 2rem;
text-decoration: none;
color: var(--text-color);
font-weight: 500;
}
nav a:hover {
color: var(--accent-color);
}
main {
max-width: 1200px;
margin: 2rem auto;
padding: 0 2rem 4rem;
}
.trip-header {
text-align: center;
margin-bottom: 3rem;
}
.trip-header h2 {
font-size: 2.5rem;
color: var(--accent-color);
margin-bottom: 0.5rem;
}
.trip-header p {
font-size: 1.1rem;
color: #666;
}
.time-section {
margin-bottom: 3rem;
}
.time-header {
display: flex;
align-items: center;
gap: 1rem;
margin-bottom: 1.5rem;
}
.time-icon {
width: 60px;
height: 60px;
background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8a 100%);
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
font-size: 1.8rem;
}
.time-header h3 {
font-size: 1.8rem;
color: var(--accent-color);
}
.stops-container {
display: flex;
flex-direction: column;
gap: 1.5rem;
}
.stop-card {
background-color: var(--card-bg);
border-radius: 12px;
padding: 1.5rem;
box-shadow: 0 4px 8px rgba(0,0,0,0.05);
display: grid;
grid-template-columns: auto 1fr;
gap: 1.5rem;
align-items: center;
transition: transform 0.2s ease;
}
.stop-card:hover {
transform: translateX(5px);
}
.stop-number {
width: 50px;
height: 50px;
background-color: var(--accent-color);
color: white;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
font-size: 1.5rem;
font-weight: 700;
flex-shrink: 0;
}
.stop-content h4 {
font-size: 1.3rem;
color: var(--accent-color);
margin-bottom: 0.3rem;
}
.stop-time {
color: #999;
font-size: 0.9rem;
margin-bottom: 0.5rem;
}
.stop-description {
color: #555;
line-height: 1.6;
}
.stop-tag {
display: inline-block;
padding: 0.3rem 0.8rem;
background-color: var(--bg-color);
color: var(--accent-color);
border-radius: 15px;
font-size: 0.85rem;
margin-top: 0.5rem;
font-weight: 500;
}
.map-section {
margin-top: 4rem;
}
.map-section h3 {
font-size: 1.8rem;
color: var(--accent-color);
margin-bottom: 1.5rem;
text-align: center;
}
#map {
height: 400px;
border-radius: 12px;
box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}
@media (max-width: 768px) {
header {
flex-direction: column;
align-items: flex-start;
padding: 1.5rem;
}
nav {
margin-top: 0.5rem;
}
nav a {
margin-left: 0;
margin-right: 1.5rem;
}
main {
padding: 1.5rem;
}
.trip-header h2 {
font-size: 2rem;
}
.stop-card {
grid-template-columns: 1fr;
}
}
</style>
</head>
<body>
<header>
<h1>Discoverly</h1>
<nav>
<a href="login.html">Log In</a>
<a href="index.html">Home</a>
<a href="hub.html">Plan Your Trip</a>
<a href="about.html">About</a>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>
</nav>
</header>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
crossorigin=""></script>

<main>
<div class="trip-header">
<h2>Perfect 1-Day Trip</h2>
<p>Experience the best of the town in one unforgettable day</p>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">☀️</div>
<h3>Morning (9:00 AM - 12:00 PM)</h3>
</div>
<div class="stops-container">
<a href="../pages-layout/activity_layout.php?activityID=1" style="text-decoration: none; color: inherit;">
  <div class="stop-card">
    <div class="stop-number">1</div>
    <div class="stop-content">
      <h4>Sunday Flea Market</h4>
      <p class="stop-time">9:00 AM - 10:30 AM</p>
      <p class="stop-description">Start your day at the vibrant Sunday flea market.</p>
      <span class="stop-tag">Market</span>
    </div>
  </div>
</a>


<a href="../pages-layout/page_layout.php?placeID=4" style="text-decoration: none; color: inherit;">
  <div class="stop-card">
    <div class="stop-number">2</div>
    <div class="stop-content">
      <h4>The Alchemist's Café</h4>
      <p class="stop-time">10:45 AM - 11:30 AM</p>
      <p class="stop-description">Take a coffee break at this cozy cellar café. Try their famous hot chocolate and homemade apple strudel.</p>
      <span class="stop-tag">Café</span>
    </div>
  </div>
</a>

<a href="../pages-layout/page_layout.php?placeID=9" style="text-decoration: none; color: inherit;">
  <div class="stop-card">
    <div class="stop-number">3</div>
    <div class="stop-content">
      <h4>St. Nicholas Cathedral</h4>
      <p class="stop-time">11:30 AM - 12:00 PM</p>
      <p class="stop-description">13th century cathedral with stunning baroque interiors and bell tower views.</p>
      <span class="stop-tag">Historic Sight</span>
    </div>
  </div>
</a>
</div>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">🌤️</div>
<h3>Afternoon (12:00 PM - 5:00 PM)</h3>
</div>
<div class="stops-container">

<a href="../pages-layout/page_layout.php?placeID=2" style="text-decoration: none; color: inherit;">
  <div class="stop-card">
    <div class="stop-number">4</div>
    <div class="stop-content">
      <h4>River View Bistro</h4>
      <p class="stop-time">12:30 PM - 2:00 PM</p>
      <p class="stop-description">Enjoy lunch with stunning riverside views. Try the seasonal menu featuring local ingredients.</p>
      <span class="stop-tag">Restaurant</span>
    </div>
  </div>
</a>

<a href="../pages-layout/page_layout.php?placeID=7" style="text-decoration: none; color: inherit;">
  <div class="stop-card">
    <div class="stop-number">5</div>
    <div class="stop-content">
      <h4>Castle Hill</h4>
      <p class="stop-time">2:30 PM - 4:30 PM</p>
      <p class="stop-description">Visit the medieval fortress for panoramic city views. Explore the museum and walk the ancient ramparts.</p>
      <span class="stop-tag">Historic Sight</span>
    </div>
  </div>
</a>

<a href="../pages-layout/page_layout.php?placeID=13" style="text-decoration: none; color: inherit;">
  <div class="stop-card">
    <div class="stop-number">6</div>
    <div class="stop-content">
      <h4>Monastery Gardens</h4>
      <p class="stop-time">4:45 PM - 5:30 PM</p>
      <p class="stop-description">Relax in these peaceful hidden gardens with rare herbs and a meditation labyrinth.</p>
      <span class="stop-tag">Park</span>
    </div>
  </div>
</a>

</div>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">🌙</div>
<h3>Evening (6:00 PM - 10:00 PM)</h3>
</div>
<div class="stops-container">

<a href="../pages-layout/page_layout.php?placeID=8" style="text-decoration: none; color: inherit;">
  <div class="stop-card">
    <div class="stop-number">7</div>
    <div class="stop-content">
      <h4>Dragon Bridge</h4>
      <p class="stop-time">6:00 PM - 6:30 PM</p>
      <p class="stop-description">Watch the sunset from this iconic Art Nouveau bridge adorned with dragon statues.</p>
      <span class="stop-tag">Historic Sight</span>
    </div>
  </div>
</a>

<a href="../pages-layout/page_layout.php?placeID=1" style="text-decoration: none; color: inherit;">
  <div class="stop-card">
    <div class="stop-number">8</div>
    <div class="stop-content">
      <h4>The Old Town Tavern</h4>
      <p class="stop-time">7:00 PM - 9:00 PM</p>
      <p class="stop-description">End your day with traditional dinner at this family-run restaurant. Try their legendary goulash.</p>
      <span class="stop-tag">Restaurant</span>
    </div>
  </div>
</a>

<a href="../pages-layout/page_layout.php?placeID=10" style="text-decoration: none; color: inherit;">
  <div class="stop-card">
    <div class="stop-number">9</div>
    <div class="stop-content">
      <h4>National Gallery</h4>
      <p class="stop-time">9:30 PM - 11:00 PM</p>
      <p class="stop-description">Optional: Visit the evening art exhibition featuring local and international art from medieval to modern.</p>
      <span class="stop-tag">Museum</span>
    </div>
  </div>
</a>

</div>
</div>

<div class="map-section">
<h3>Your Route Map</h3>
<div id="map"></div>
</main>
<script>
var map = L.map('map').setView([46.0569, 14.5058], 13); 

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);


var coordinates = <?= json_encode($coordinates) ?>;

var routePoints = [];

// adding numbers and markers for each place
coordinates.forEach(function(place, index) {
    if (place.lat && place.lng) {
        var stopNumber = index + 1;
        
        // creating the marker
        var numberIcon = L.divIcon({
            className: 'custom-marker',
            html: `<div style="background-color: #1e3a5f; color: white; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">${stopNumber}</div>`,
            iconSize: [35, 35],
            iconAnchor: [17, 17]
        });
        
        // adding the marker 
        L.marker([place.lat, place.lng], {icon: numberIcon})
            .addTo(map)
            .bindPopup(`<b>${stopNumber}. ${place.name}</b>`);
        
        // saving it's position 
        routePoints.push([place.lat, place.lng]);
    }
});

// drawing a line to connect all markers
if (routePoints.length > 1) {
    L.polyline(routePoints, {
        color: '#1e3a5f',
        weight: 3,
        opacity: 0.7,
        dashArray: '10, 5'
    }).addTo(map);
}

// adjusting the map so that we can see all the markers 
if (routePoints.length > 0) {
    map.fitBounds(routePoints);
}
</script>

</body>
</html>