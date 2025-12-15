<?php
session_start();
include "../Scripts/Config.php";

if (!isset($_SESSION['userID'])) {
    header("Location: login.php?error=notloggedin");
    exit();
}

$user_id = $_SESSION['userID'];

$sql = "SELECT username, email FROM Users WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$initials = strtoupper(substr($user['username'], 0, 2));

$user_id = $_SESSION['userID'];

$sql_places = "SELECT * FROM Place WHERE userID = ?";
$stmt_places = $conn->prepare($sql_places);
$stmt_places->bind_param("i", $user_id);
$stmt_places->execute();
$result_places = $stmt_places->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Profile - Discoverly</title>

  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/user-profile.css">

  <script src="../Scripts/user-profile.js" defer></script>
</head>

<body>
  <div class="site-wrapper">

    <header>
      <h1 class="logo">Discoverly</h1>
      <nav>
        <a href="../index.php">Home</a>
        <a href="hub.php">Plan Your Trip</a>

        <?php if (isset($_SESSION['userID'])): ?>
          <a href="../Scripts/logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
          <a href="login.php">Login</a>
        <?php endif; ?>
      </nav>
    </header>

    <main>
      <div class="profile-header">
        <div class="profile-pic"><?php echo $initials; ?></div>

        <div class="profile-info">
          <h2><?php echo htmlspecialchars($user['username']); ?></h2>
          <p><?php echo htmlspecialchars($user['email']); ?></p>

          <div class="profile-stats">
            <div class="stat">
              <span class="stat-number">5</span>
              <span class="stat-label">Saved Places</span>
            </div>
            <div class="stat">
              <span class="stat-number">3</span>
              <span class="stat-label">Reviews</span>
            </div>
            <div class="stat">
              <span class="stat-number">2</span>
              <span class="stat-label">Visited</span>
            </div>
          </div>

          <button class="btn-edit" onclick="window.location='edituser.php'">Edit Profile</button>
        </div>
      </div>

      <div class="section">
        <div class="section-header">
          <h3 class="section-title">My Added Places</h3>
        </div>

        <div class="saved-grid">
          <?php while ($place = $result_places->fetch_assoc()): ?>
            <div class="saved-card">
              <img
                class="saved-image"
                src="<?php echo explode(',', $place['photos'])[0]; ?>"
                alt="<?php echo htmlspecialchars($place['name']); ?>"
              >

              <div class="saved-content">
                <h3><?php echo htmlspecialchars($place['name']); ?></h3>
                <p><?php echo htmlspecialchars(substr($place['about'], 0, 110)); ?>...</p>
                <span class="tag"><?php echo ucfirst($place['type']); ?></span>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </main>

  </div>
</body>
</html>
