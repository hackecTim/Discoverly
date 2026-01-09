<?php
session_start();


if (!isset($_SESSION['userID'])) {
    header("Location: login.php?error=loginrequired");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create New Place - Discoverly</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
<link rel="stylesheet" href="../css/base.css">
<link rel="stylesheet" href="../css/createExp.css">

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
          integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
          crossorigin=""></script>
<script src="../Scripts/createEXP.js"></script> 
<script src="../Scripts/base.js" defer></script>

</head>

<body>
    <?php
      $current = 'Create Experience';
      $pill = 'Create Experience';
      include __DIR__ . "/../partials/header_sites.php";
    ?>
<main class="container">

    <h2>Create New Place</h2>
    <p class="subtitle">Add a new attraction, restaurant, café or sight</p>

    <form action="../Scripts/createExphandler.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Place Name</label>
            <input type="text" name="name" required placeholder="Dragon Bridge">
        </div>

        <div class="form-group">
            <label>Type</label>
            <select name="type" required>
                <option value="">Select type</option>
                <option value="restaurant">Restaurant</option>
                <option value="cafe">Café</option>
                <option value="historic">Historic Sight</option>
                <option value="park">Park</option>
                <option value="museum">Museum</option>
                <option value="activity">Activity</option>
            </select>
        </div>

        <div class="form-group">
            <label>About</label>
            <textarea name="about" rows="4" maxlength="900" required placeholder="Describe this place..."></textarea>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" required placeholder="Kresija 10, Ljubljana">
        </div>

        <div class="form-group">
            <label>Opening Hours</label>
            <input type="text" name="hours" placeholder="Mon–Sun: 8:00–20:00">
        </div>

        <div class="form-group">
            <label>Price (estimated €)</label>
            <input type="text" name="price" placeholder="Example: €€">
        </div>

        <div class="form-group">
            <label>Contact</label>
            <input type="text" name="contact" placeholder="+386 31 000 000">
        </div>

        <div class="form-group">
            <label>Website</label>
            <input type="url" name="website" placeholder="https://example.com">
        </div>

        <div class="form-group">
            <label>Accessibility</label>
            <input type="text" name="accessibility" placeholder="Wheelchair accessible">
        </div>

        <div class="form-group">
            <label>Recommended Duration (minutes)</label>
            <input type="number" name="duration" placeholder="30">
        </div>

        <div class="form-group">
            <label>Photos (multiple allowed)</label>
            <input type="file" name="photos[]" multiple accept="image/*">
        </div>

        <input type="hidden" name="latitude" required>
        <input type="hidden" name="longitude" required>

        <div class="form-group">
            <label>Select location on map</label>
            <div id="map"></div>
            <small class="hint">Click on the map to choose the location</small>
        </div>

        <button type="submit" class="btn">Create Place</button>

    </form>

</main>
<?php include __DIR__ . "/../partials/footer.php"; ?>

</body>
</html>






