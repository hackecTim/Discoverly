<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>5-Day Trip - Discoverly</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="../css/base.css" />
  <link rel="stylesheet" href="../css/5_day_trip.css" />
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
<h2>5-Day Deep Dive</h2>
<p>Live like a local and discover the true character of the town</p>
</div>

<div class="day-tabs" id="myBtnContainer">
<button class="day-tab active" onclick="showDay(1)">Day 1</button>
<button class="day-tab" onclick="showDay(2)">Day 2</button>
<button class="day-tab" onclick="showDay(3)">Day 3</button>
<button class="day-tab" onclick="showDay(4)">Day 4</button>
<button class="day-tab" onclick="showDay(5)">Day 5</button>
</div>

<!-- DAY 1 -->
<div id="day1" class="day-content active">
<div class="day-title">
<h3>Day 1: Arrival & Old Town</h3>
<p>Get oriented and explore the historic center</p>
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
<p class="stop-time">10:00 AM - 11:30 AM</p>
<p class="stop-description">Start with the colorful baroque square to get your bearings.</p>
<span class="stop-tag">Historic Sight</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">2</div>
<div class="stop-content">
<h5>Brew & Pages</h5>
<p class="stop-time">11:45 AM - 12:30 PM</p>
<p class="stop-description">Coffee and light lunch at this bookshop café.</p>
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
<h5>Dragon Bridge</h5>
<p class="stop-time">1:00 PM - 1:30 PM</p>
<p class="stop-description">Visit the iconic Art Nouveau bridge.</p>
<span class="stop-tag">Historic Sight</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">4</div>
<div class="stop-content">
<h5>City History Museum</h5>
<p class="stop-time">2:00 PM - 4:00 PM</p>
<p class="stop-description">Learn the town's story through interactive exhibits.</p>
<span class="stop-tag">Museum</span>
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
<h5>The Old Town Tavern</h5>
<p class="stop-time">7:00 PM - 9:00 PM</p>
<p class="stop-description">Welcome dinner with traditional cuisine.</p>
<span class="stop-tag">Restaurant</span>
</div>
</div>
</div>
</div>
</div>

<!-- DAY 2 -->
<div id="day2" class="day-content">
<div class="day-title">
<h3>Day 2: Heights & Views</h3>
<p>Explore elevated perspectives and panoramas</p>
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
<h5>Sunrise Castle Hill Hike</h5>
<p class="stop-time">6:30 AM - 8:00 AM</p>
<p class="stop-description">Early morning hike to watch sunrise from the fortress.</p>
<span class="stop-tag">Activity</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">2</div>
<div class="stop-content">
<h5>The Alchemist's Café</h5>
<p class="stop-time">9:00 AM - 10:00 AM</p>
<p class="stop-description">Post-hike breakfast and famous hot chocolate.</p>
<span class="stop-tag">Café</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">3</div>
<div class="stop-content">
<h5>Castle Hill Museum</h5>
<p class="stop-time">10:30 AM - 12:30 PM</p>
<p class="stop-description">Explore the museum you missed at sunrise.</p>
<span class="stop-tag">Historic Sight</span>
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
<h5>River View Bistro</h5>
<p class="stop-time">1:00 PM - 2:30 PM</p>
<p class="stop-description">Lunch with riverside views.</p>
<span class="stop-tag">Restaurant</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">5</div>
<div class="stop-content">
<h5>Riverside Bike Tour</h5>
<p class="stop-time">3:00 PM - 5:00 PM</p>
<p class="stop-description">Cycle scenic trails along the river.</p>
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
<h5>Grandma's Kitchen</h5>
<p class="stop-time">7:00 PM - 9:00 PM</p>
<p class="stop-description">Comfort food dinner featuring legendary goulash.</p>
<span class="stop-tag">Restaurant</span>
</div>
</div>
</div>
</div>
</div>

<!-- DAY 3 -->
<div id="day3" class="day-content">
<div class="day-title">
<h3>Day 3: Art & Culture</h3>
<p>Immerse yourself in creative spaces</p>
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
<h5>National Gallery</h5>
<p class="stop-time">9:30 AM - 12:00 PM</p>
<p class="stop-description">Explore extensive art collections from medieval to modern.</p>
<span class="stop-tag">Museum</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">2</div>
<div class="stop-content">
<h5>Riverside Roasters</h5>
<p class="stop-time">12:15 PM - 1:00 PM</p>
<p class="stop-description">Coffee break at waterfront café.</p>
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
<h5>Museum of Contemporary Art</h5>
<p class="stop-time">2:00 PM - 4:00 PM</p>
<p class="stop-description">Cutting-edge exhibitions by local and international artists.</p>
<span class="stop-tag">Museum</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">4</div>
<div class="stop-content">
<h5>Watercolor Workshop</h5>
<p class="stop-time">4:30 PM - 6:30 PM</p>
<p class="stop-description">Paint local landscapes with a professional artist.</p>
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
<div class="stop-number">5</div>
<div class="stop-content">
<h5>Local Food Walking Tour</h5>
<p class="stop-time">7:00 PM - 9:00 PM</p>
<p class="stop-description">Guided tasting tour at hidden eateries.</p>
<span class="stop-tag">Activity</span>
</div>
</div>
</div>
</div>
</div>

<!-- DAY 4 -->
<div id="day4" class="day-content">
<div class="day-title">
<h3>Day 4: Nature & Relaxation</h3>
<p>Unwind in green spaces and peaceful spots</p>
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
<p class="stop-description">Outdoor yoga session by the water.</p>
<span class="stop-tag">Activity</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">2</div>
<div class="stop-content">
<h5>Monastery Gardens</h5>
<p class="stop-time">9:30 AM - 11:30 AM</p>
<p class="stop-description">Peaceful exploration of hidden botanical gardens.</p>
<span class="stop-tag">Park</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">3</div>
<div class="stop-content">
<h5>The Alchemist's Café</h5>
<p class="stop-time">12:00 PM - 1:00 PM</p>
<p class="stop-description">Light lunch and pastries.</p>
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
<div class="stop-number">4</div>
<div class="stop-content">
<h5>River Walk Promenade</h5>
<p class="stop-time">1:30 PM - 3:00 PM</p>
<p class="stop-description">Leisurely stroll along willow-lined paths.</p>
<span class="stop-tag">Park</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">5</div>
<div class="stop-content">
<h5>Central Park</h5>
<p class="stop-time">3:30 PM - 5:30 PM</p>
<p class="stop-description">Relax in the urban park, maybe catch an outdoor concert.</p>
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
<p class="stop-description">Learn to cook local dishes, includes dinner.</p>
<span class="stop-tag">Activity</span>
</div>
</div>
</div>
</div>
</div>

<!-- DAY 5 -->
<div id="day5" class="day-content">
<div class="day-title">
<h3>Day 5: Local Life & Farewell</h3>
<p>Experience authentic local culture before departure</p>
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
<p class="stop-description">Last-minute souvenir hunting at the vibrant market.</p>
<span class="stop-tag">Market</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">2</div>
<div class="stop-content">
<h5>Brew & Pages</h5>
<p class="stop-time">10:30 AM - 11:30 AM</p>
<p class="stop-description">Farewell coffee and reflection time.</p>
<span class="stop-tag">Café</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">3</div>
<div class="stop-content">
<h5>St. Nicholas Cathedral</h5>
<p class="stop-time">12:00 PM - 1:00 PM</p>
<p class="stop-description">Visit the stunning 13th century cathedral.</p>
<span class="stop-tag">Historic Sight</span>
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
<h5>River View Bistro</h5>
<p class="stop-time">1:30 PM - 3:00 PM</p>
<p class="stop-description">Final lunch with your favorite riverside views.</p>
<span class="stop-tag">Restaurant</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">5</div>
<div class="stop-content">
<h5>Wine Cellar Tour</h5>
<p class="stop-time">3:30 PM - 5:30 PM</p>
<p class="stop-description">Sample regional wines in underground cellars.</p>
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
<h5>Castle Hill Sunset</h5>
<p class="stop-time">6:30 PM - 7:30 PM</p>
<p class="stop-description">Watch your final sunset from the fortress.</p>
<span class="stop-tag">Historic Sight</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">7</div>
<div class="stop-content">
<h5>The Old Town Tavern</h5>
<p class="stop-time">8:00 PM - 10:00 PM</p>
<p class="stop-description">Farewell dinner at the place where it all began.</p>
<span class="stop-tag">Restaurant</span>
</div>
</div>

<div class="stop-card">
<div class="stop-number">8</div>
<div class="stop-content">
<h5>Jazz Night at The Cellar</h5>
<p class="stop-time">10:30 PM - Midnight</p>
<p class="stop-description">End your journey with live jazz and memories.</p>
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