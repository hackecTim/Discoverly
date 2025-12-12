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

<link rel="stylesheet" href="../Style/createExp.css">
<script src="../Scripts/createExp.js"></script> 

</head>

<body>

<header class="navbar">
    <div class="logo">Discoverly</div>

    <nav class="nav-links">
        <a href="index.php">Home</a>
        <a href="page1.php">Plan Your Trip</a>
        <a href="about.php">About</a>

        <?php if (isset($_SESSION['userID'])): ?>
            <a href="user-profile.php">My Profile</a>
            <a class="logout" href="Scripts/logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>

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
            <input type="number" name="price" placeholder="Example: 15">
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

        <button type="submit" class="btn">Create Place</button>

    </form>

</main>

</body>
</html>
