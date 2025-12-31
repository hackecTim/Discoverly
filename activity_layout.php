<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "Root123!@#", "discoverly");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get activity ID from URL (default to 1)
$activityID = isset($_GET['activityID']) ? intval($_GET['activityID']) : 1;

// GET ACTIVITY DETAILS
$sqlActivity = "SELECT * FROM Activity WHERE activityID = ?";
$stmtActivity = $conn->prepare($sqlActivity);
$stmtActivity->bind_param("i", $activityID);
$stmtActivity->execute();
$activity = $stmtActivity->get_result()->fetch_assoc();

if (!$activity) {
    die("Activity not found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($activity['name']) ?> - Discoverly</title>

  <link rel="stylesheet" href="../css/pages_layout.css" />
  <link rel="stylesheet" href="../css/base.css" />

  <script src="../Scripts/base.js" defer></script>
  <script src="./page_layout.js" defer></script>
</head>

<body>
    <?php
      $current = 'Activities';
      $pill = 'Activities';
      include __DIR__ . "/../partials/header_sites.php";
    ?>

<img src="<?= htmlspecialchars($activity['photos']) ?>"
     alt="<?= htmlspecialchars($activity['name']) ?>"
     class="hero-image">

<main>
  <div class="detail-header">
    <div class="title-section">
      <h2><?= htmlspecialchars($activity['name']) ?></h2>
      <span class="category-tag">Activity</span>
    </div>
    <button class="btn-save" onclick="showLoginModal()">Add to My List</button>
  </div>

  <div class="info-side" style="max-width: 900px; margin: 0 auto;">
    <div class="info-section">
      <h3>About This Activity</h3>
      <p><?= nl2br(htmlspecialchars($activity['description'])) ?></p>
    </div>

    <div class="info-section">
      <h3>Details</h3>
      <div class="info-item">
        <span class="info-icon">📅</span>
        <span><strong>Schedule:</strong> <?= htmlspecialchars($activity['schedule']) ?></span>
      </div>
      <div class="info-item">
        <span class="info-icon">⏱️</span>
        <span><strong>Duration:</strong> <?= htmlspecialchars($activity['duration']) ?> hours</span>
      </div>
      <div class="info-item">
        <span class="info-icon">💰</span>
        <span><strong>Price:</strong> <?= $activity['price'] == 0 ? 'Free' : '€' . htmlspecialchars($activity['price']) ?></span>
      </div>
    </div>
  </div>
</main>

<!-- Login Modal -->
<div class="login-modal" id="loginModal">
  <div class="modal-content">
    <h3>Login Required</h3>
    <p>Please log in to save activities to your list</p>
    <div class="modal-buttons">
      <a href="../Sites/login.php" class="btn-modal btn-login">Log In</a>
      <button class="btn-modal btn-cancel" onclick="hideLoginModal()">Cancel</button>
    </div>
  </div>
</div>

</body>
<?php include __DIR__ . "/../partials/footer.php"; ?>
</html>