<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>3-Day Trip - Discoverly</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="../css/base.css" />
  <link rel="stylesheet" href="../css/3_day_trip.css" />
  <script src="../Scripts/base.js" defer></script>
</head>
<body>

<?php
      include __DIR__ . "/../partials/header_sites.php";
    ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
crossorigin=""></script>

<main>
<div class="trip-header">
<h2>3-Day Adventure</h2>
<p>Dive deeper into local culture with three unforgettable days</p>
</div>

<div class="day-tabs" id="myBtnContainer">
<button class="day-tab active" onclick="showDay(1)">Day 1</button>
<button class="day-tab" onclick="showDay(2)">Day 2</button>
<button class="day-tab" onclick="showDay(3)">Day 3</button>
</div>

<!-- DAY 1 -->
<div id="day1" class="day-content active">
<div class="day-title">
<h3>Day 1: Old Town Exploration</h3>
<p>Discover the historic heart and iconic landmarks</p>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">☀️</div>
<h4>Morning</h4>
</div>
<div class="stops-container">
<div class="stop-card">
<div class="stop-number">1</div>
<div class="stop-content">
<h5>Old Market Square</h5>
<p class="stop-time">9:00 AM - 10:00 AM</p>
<p class="stop-description">Start your day exploring the colorful baroque square and local shops.</p>
<span class="stop-tag">Historic Sight</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">2</div>
<div class="stop-content">
<h5>The Alchemist's Café</h5>
<p class="stop-time">10:15 AM - 11:00 AM</p>
<p class="stop-description">Coffee break at the famous cellar café with homemade pastries.</p>
<span class="stop-tag">Café</span>
</div>
</div>
</div>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">🌤️</div>
<h4>Afternoon</h4>
</div>
<div class="stops-container">
<div class="stop-card">
<div class="stop-number">3</div>
<div class="stop-content">
<h5>Grandma's Kitchen</h5>
<p class="stop-time">12:30 PM - 2:00 PM</p>
<p class="stop-description">Traditional lunch featuring the legendary goulash.</p>
<span class="stop-tag">Restaurant</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">4</div>
<div class="stop-content">
<h5>Castle Hill</h5>
<p class="stop-time">2:30 PM - 5:00 PM</p>
<p class="stop-description">Explore the medieval fortress and panoramic city views.</p>
<span class="stop-tag">Historic Sight</span>
</div>
</div>
</div>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">🌙</div>
<h4>Evening</h4>
</div>
<div class="stops-container">
<div class="stop-card">
<div class="stop-number">5</div>
<div class="stop-content">
<h5>Dragon Bridge</h5>
<p class="stop-time">5:30 PM - 6:00 PM</p>
<p class="stop-description">Watch sunset from the iconic Art Nouveau bridge.</p>
<span class="stop-tag">Historic Sight</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">6</div>
<div class="stop-content">
<h5>River View Bistro</h5>
<p class="stop-time">7:00 PM - 9:00 PM</p>
<p class="stop-description">Riverside dinner with seasonal menu and wine pairing.</p>
<span class="stop-tag">Restaurant</span>
</div>
</div>
</div>
</div>
</div>

<!-- DAY 2 -->
<div id="day2" class="day-content">
<div class="day-title">
<h3>Day 2: Nature & Culture</h3>
<p>Experience green spaces and artistic treasures</p>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">☀️</div>
<h4>Morning</h4>
</div>
<div class="stops-container">
<div class="stop-card">
<div class="stop-number">1</div>
<div class="stop-content">
<h5>Riverside Yoga</h5>
<p class="stop-time">8:00 AM - 9:00 AM</p>
<p class="stop-description">Start with outdoor yoga by the water for a refreshing morning.</p>
<span class="stop-tag">Activity</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">2</div>
<div class="stop-content">
<h5>Brew & Pages</h5>
<p class="stop-time">9:30 AM - 10:30 AM</p>
<p class="stop-description">Breakfast at this bookshop café with specialty coffee.</p>
<span class="stop-tag">Café</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">3</div>
<div class="stop-content">
<h5>National Gallery</h5>
<p class="stop-time">11:00 AM - 1:00 PM</p>
<p class="stop-description">Explore local and international art collections.</p>
<span class="stop-tag">Museum</span>
</div>
</div>
</div>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">🌤️</div>
<h4>Afternoon</h4>
</div>
<div class="stops-container">
<div class="stop-card">
<div class="stop-number">4</div>
<div class="stop-content">
<h5>Local Food Tour</h5>
<p class="stop-time">2:00 PM - 4:00 PM</p>
<p class="stop-description">Guided tasting tour at hidden local eateries.</p>
<span class="stop-tag">Activity</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">5</div>
<div class="stop-content">
<h5>Monastery Gardens</h5>
<p class="stop-time">4:30 PM - 6:00 PM</p>
<p class="stop-description">Peaceful stroll through hidden botanical gardens.</p>
<span class="stop-tag">Park</span>
</div>
</div>
</div>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">🌙</div>
<h4>Evening</h4>
</div>
<div class="stops-container">
<div class="stop-card">
<div class="stop-number">6</div>
<div class="stop-content">
<h5>Traditional Cooking Workshop</h5>
<p class="stop-time">6:30 PM - 9:00 PM</p>
<p class="stop-description">Learn to cook local dishes with a chef, includes dinner.</p>
<span class="stop-tag">Activity</span>
</div>
</div>
</div>
</div>
</div>

<!-- DAY 3 -->
<div id="day3" class="day-content">
<div class="day-title">
<h3>Day 3: Local Secrets & Relaxation</h3>
<p>Discover hidden spots and unwind</p>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">☀️</div>
<h4>Morning</h4>
</div>
<div class="stops-container">
<div class="stop-card">
<div class="stop-number">1</div>
<div class="stop-content">
<h5>Sunday Flea Market</h5>
<p class="stop-time">8:00 AM - 10:00 AM</p>
<p class="stop-description">Hunt for vintage treasures and local crafts.</p>
<span class="stop-tag">Market</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">2</div>
<div class="stop-content">
<h5>Riverside Roasters</h5>
<p class="stop-time">10:30 AM - 11:30 AM</p>
<p class="stop-description">Coffee at waterfront café roasting their own beans.</p>
<span class="stop-tag">Café</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">3</div>
<div class="stop-content">
<h5>River Walk Promenade</h5>
<p class="stop-time">11:30 AM - 12:30 PM</p>
<p class="stop-description">Scenic walk along willow-lined riverside path.</p>
<span class="stop-tag">Park</span>
</div>
</div>
</div>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">🌤️</div>
<h4>Afternoon</h4>
</div>
<div class="stops-container">
<div class="stop-card">
<div class="stop-number">4</div>
<div class="stop-content">
<h5>The Old Town Tavern</h5>
<p class="stop-time">1:00 PM - 2:30 PM</p>
<p class="stop-description">Final meal at this beloved family restaurant.</p>
<span class="stop-tag">Restaurant</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">5</div>
<div class="stop-content">
<h5>Wine Cellar Tour</h5>
<p class="stop-time">3:00 PM - 5:00 PM</p>
<p class="stop-description">Sample regional wines in historic underground cellars.</p>
<span class="stop-tag">Activity</span>
</div>
</div>
</div>
</div>

<div class="time-section">
<div class="time-header">
<div class="time-icon">🌙</div>
<h4>Evening</h4>
</div>
<div class="stops-container">
<div class="stop-card">
<div class="stop-number">6</div>
<div class="stop-content">
<h5>Central Park</h5>
<p class="stop-time">6:00 PM - 7:00 PM</p>
<p class="stop-description">Relax and reflect on your trip at the urban park.</p>
<span class="stop-tag">Park</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">7</div>
<div class="stop-content">
<h5>Jazz Night at The Cellar</h5>
<p class="stop-time">8:00 PM - 10:00 PM</p>
<p class="stop-description">End your trip with live jazz in intimate underground venue.</p>
<span class="stop-tag">Nightlife</span>
</div>
</div>
</div>
</div>
</div>

<div class="map-section">
<h3 id="map-title">Route Map</h3>
<div id="map"></div>
</div>
</main>

<script src="filter.js"></script>

</body>
</html>