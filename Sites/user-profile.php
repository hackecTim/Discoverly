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

$sql_places = "SELECT * FROM Place WHERE userID = ?";
$stmt_places = $conn->prepare($sql_places);
$stmt_places->bind_param("i", $user_id);
$stmt_places->execute();
$result_places = $stmt_places->get_result();

//Favoriti

$sql_places2 = "
  SELECT Place.*
  FROM Wishlist
  JOIN Place ON Wishlist.placeID = Place.placeID
  WHERE Wishlist.userID = ?
";

$stmt_places2 = $conn->prepare($sql_places2);
$stmt_places2->bind_param("i", $user_id);
$stmt_places2->execute();
$result_places2 = $stmt_places2->get_result();

//User stats
$stmt = $conn->prepare("
    SELECT COUNT(*) AS total 
    FROM Wishlist 
    WHERE userID = ?
");
$stmt->bind_param("i", $userID);
$stmt->execute();
$savedPlaces = $stmt->get_result()->fetch_assoc()['total'];


$stmt = $conn->prepare("
    SELECT COUNT(*) AS total 
    FROM Review 
    WHERE userID = ?
");
$stmt->bind_param("i", $userID);
$stmt->execute();
$reviewsCount = $stmt->get_result()->fetch_assoc()['total'];


$stmt = $conn->prepare("
    SELECT COUNT(*) AS total 
    FROM  Wishlist
    WHERE userID = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$visitedCount = $stmt->get_result()->fetch_assoc()['total'];
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
  <script src="../Scripts/base.js" defer></script>

</head>

<body>
  <div class="site-wrapper">
    <?php
      $current = 'profile';
      $pill = 'Profile';
      include __DIR__ . "/../partials/header_sites.php";
    ?>

    <main class="page">
      <section class="profile-hero">
        <div class="profile-header">
          <div class="profile-pic"><?php echo $initials; ?></div>

          <div class="profile-info">
            <h2><?php echo htmlspecialchars($user['username']); ?></h2>
            <p><?php echo htmlspecialchars($user['email']); ?></p>

            <div class="profile-stats">

			<div class="stat">
				<span class="stat-number"><?= $savedPlaces ?></span>
				<span class="stat-label">Saved Places</span>
			</div>

			<div class="stat">
				<span class="stat-number"><?= $reviewsCount ?></span>
				<span class="stat-label">Reviews</span>
			</div>

			<div class="stat">
				<span class="stat-number"><?= $visitedCount ?></span>
				<span class="stat-label">Visited</span>
			</div>

</div>

            <div class="profile-actions">
              <a class="btn-edit" href="edituser.php">Edit Profile</a>
            </div>
          </div>
        </div>
      </section>

      <section class="section">
  <div class="section-header">
    <div>
      <h3 class="section-title">My Added Places</h3>
      <p class="section-subtitle">Places you personally added.</p>
    </div>
  </div>

  <div class="saved-grid">

    <?php if ($result_places->num_rows === 0): ?>
      <div class="empty-state">
        <h4>No added places</h4>
        <p>You haven’t added any places yet.</p>
        <a href="../Sites/create_place.php" class="btn-primary">
          Add your first place
        </a>
      </div>
    <?php endif; ?>

    <?php while ($place = $result_places->fetch_assoc()): ?>
      <article class="saved-card">

        <a href="../pages-layout/page_layout.php?id=<?= (int)$place['placeID'] ?>"
           class="saved-link">

          <div class="saved-media">
            <?php
              $photosRaw = $place['photos'] ?? '';
              $firstPhoto = '';
              if (!empty($photosRaw)) {
                $parts = array_map('trim', explode(',', $photosRaw));
                $firstPhoto = $parts[0] ?? '';
              }
              if (empty($firstPhoto)) {
                $firstPhoto = '../uploads_places/placeholder.jpg';
              }
            ?>

            <img
              class="saved-image"
              src="<?= htmlspecialchars($firstPhoto) ?>"
              alt="<?= htmlspecialchars($place['name']) ?>"
              loading="lazy"
            >

            <span class="tag"><?= ucfirst($place['type']) ?></span>
          </div>

          <div class="saved-content">
            <h3><?= htmlspecialchars($place['name']) ?></h3>
            <p><?= htmlspecialchars(substr($place['about'], 0, 110)) ?>...</p>

            <div class="card-actions">
              <span class="meta">Added by you</span>
            </div>
          </div>

        </a>

      </article>
    <?php endwhile; ?>

  </div>
</section>
	  <section class="section">
  <div class="section-header">
    <div>
      <h3 class="section-title">My Saved Places</h3>
      <p class="section-subtitle">Places you added to your favorites.</p>
    </div>
  </div>

  <div class="saved-grid">

    <?php if ($result_places2->num_rows === 0): ?>
      <div class="empty-state">
        <h4>No saved places</h4>
        <p>You haven’t added any places to your favorites yet.</p>
        <a href="../index.php" class="btn-primary">Explore places</a>
      </div>
    <?php endif; ?>

    <?php while ($place = $result_places2->fetch_assoc()): ?>
      <article class="saved-card">

        <a href="../pages-layout/page_layout.php?id=<?= (int)$place['placeID'] ?>" class="saved-link">

          <div class="saved-media">
            <?php
              $photosRaw = $place['photos'] ?? '';
              $firstPhoto = '';
              if (!empty($photosRaw)) {
                $parts = array_map('trim', explode(',', $photosRaw));
                $firstPhoto = $parts[0] ?? '';
              }
              if (empty($firstPhoto)) {
                $firstPhoto = '../uploads_places/placeholder.jpg';
              }
            ?>

            <img
              class="saved-image"
              src="<?= htmlspecialchars($firstPhoto) ?>"
              alt="<?= htmlspecialchars($place['name']) ?>"
              loading="lazy"
            >

            <span class="tag"><?= ucfirst($place['type']) ?></span>
          </div>

          <div class="saved-content">
            <h3><?= htmlspecialchars($place['name']) ?></h3>
            <p><?= htmlspecialchars(substr($place['about'], 0, 110)) ?>...</p>

            <div class="card-actions">
              <span class="meta">Favorite</span>
            </div>
          </div>

        </a>

      </article>
    <?php endwhile; ?>

  </div>
</section>

   </main>
</body>



</html>
