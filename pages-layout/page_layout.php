<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "Root123!@#", "discoverly");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get place ID from URL (default to 1)
$placeID = isset($_GET['placeID']) ? intval($_GET['placeID']) : 1;

// GET PLACE DETAILS
$sqlPlace = "SELECT * FROM Place WHERE placeID = ?";
$stmtPlace = $conn->prepare($sqlPlace);
$stmtPlace->bind_param("i", $placeID);
$stmtPlace->execute();
$place = $stmtPlace->get_result()->fetch_assoc();

if (!$place) {
    die("Place not found");
}

// GET REVIEWS
$sql = "SELECT Review.*, Users.username
        FROM Review
        JOIN Users ON Review.userID = Users.userID
        WHERE Review.placeID = ?
        ORDER BY Review.reviewID DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $placeID);
$stmt->execute();
$reviews = $stmt->get_result();

// GET AVERAGE RATING
$sql2 = "SELECT AVG(rating) AS avgRating, COUNT(*) AS totalReviews
         FROM Review
         WHERE placeID = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $placeID);
$stmt2->execute();
$ratingData = $stmt2->get_result()->fetch_assoc();

$avgRating = $ratingData['avgRating']
    ? number_format($ratingData['avgRating'], 1)
    : "0.0";

$totalReviews = (int)$ratingData['totalReviews'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($place['name']) ?> - Discoverly</title>

  <link rel="stylesheet" href="../css/pages_layout.css" />
    <link rel="stylesheet" href="../css/base.css" />


  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
          integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
          crossorigin=""></script>

  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  <script src="../Scripts/base.js" defer></script>
  <script src="./page_layout.js" defer></script>
</head>

<body>
    <?php
      $current = 'Page Layout';
      $pill = 'Page Layout';
      include __DIR__ . "/../partials/header_sites.php";
    ?>

<img src="<?= htmlspecialchars($place['photos']) ?>"
     alt="<?= htmlspecialchars($place['name']) ?>"
     class="hero-image">

<main>
  <div class="detail-header">
    <div class="title-section">
      <h2><?= htmlspecialchars($place['name']) ?></h2>
      <span class="category-tag"><?= htmlspecialchars($place['type']) ?></span>
    </div>
    <button class="btn-save" onclick="showLoginModal()">Add to My List</button>
  </div>

  <div class="content-grid">
    <div class="map-section">
      <div class="map-card">
        <h3>Location</h3>
        <p class="muted"><?= htmlspecialchars($place['address']) ?></p>
        <div id="map"></div>

        <button class="btn-save" style="margin-top:1rem;" onclick="showUserLocation()">Show my location</button>
        <button class="btn-save" style="margin-top:0.5rem;" onclick="routeToLocation()">Show directions</button>
      </div>
    </div>

    <div class="info-side">
      <div class="info-section">
        <h3>About</h3>
        <p><?= nl2br(htmlspecialchars($place['about'])) ?></p>
      </div>

      <div class="info-section">
        <h3>Quick Info</h3>
        <div class="info-item"><span class="info-icon"></span><span><strong>Address:</strong> <?= htmlspecialchars($place['address']) ?></span></div>
        <div class="info-item"><span class="info-icon"></span><span><strong>Hours:</strong> <?= htmlspecialchars($place['hours']) ?></span></div>
        <div class="info-item"><span class="info-icon"></span><span><strong>Price:</strong> €<?= htmlspecialchars($place['price']) ?></span></div>
        <div class="info-item"><span class="info-icon"></span><span><strong>Contact:</strong> <?= htmlspecialchars($place['contact']) ?></span></div>
        <div class="info-item"><span class="info-icon"></span><span><strong>Website:</strong> <a href="<?= htmlspecialchars($place['website']) ?>" class="link-accent"><?= htmlspecialchars($place['website']) ?></a></span></div>
        <div class="info-item"><span class="info-icon"></span><span><strong>Accessibility:</strong> <?= htmlspecialchars($place['accessibility']) ?></span></div>
        <div class="info-item"><span class="info-icon"></span><span><strong>Rating:</strong> <?= $avgRating ?> average</span></div>
        <div class="info-item"><span class="info-icon"></span><span><strong>Duration:</strong> Allow <?= htmlspecialchars($place['duration']) ?> hours</span></div>
      </div>
    </div>
  </div>

  <div class="photos-section">
    <h3 class="section-title">Photos</h3>
    <div class="photo-gallery">
      <img src="https://images.unsplash.com/photo-1464207687429-7505649dae38?w=400" alt="Castle view 1" class="gallery-photo">
      <img src="https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=400" alt="Castle view 2" class="gallery-photo">
      <img src="https://images.unsplash.com/photo-1518605408474-52322b6f4eb9?w=400" alt="Castle view 3" class="gallery-photo">
      <img src="https://images.unsplash.com/photo-1523906630133-f6934a1ab2b9?w=400" alt="Castle view 4" class="gallery-photo">
      <img src="https://images.unsplash.com/photo-1519817914152-22d216bb9170?w=400" alt="Castle view 5" class="gallery-photo">
    </div>
  </div>

  <div class="reviews-section">
    <div class="reviews-header">
      <div>
        <h3>Reviews</h3>
        <div class="overall-rating">
          <span class="rating-number"><?= $avgRating ?></span>

          <div class="rating-stars" aria-label="Average rating">
            <?php
              $fullStars = floor($avgRating);
              $halfStar  = ($avgRating - $fullStars) >= 0.5;
              $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

              echo str_repeat("★", $fullStars);
              if ($halfStar) echo "½";
              echo str_repeat("☆", $emptyStars);
            ?>
          </div>

          <div class="rating-count">
            Based on <?= $totalReviews ?> review<?= $totalReviews == 1 ? "" : "s" ?>
          </div>
        </div>
      </div>

      <?php if (isset($_SESSION['userID'])): ?>
        <button class="btn-review" onclick="openReviewForm()">Leave a Review</button>
      <?php else: ?>
        <button class="btn-review" onclick="showLoginModal()">Leave a Review</button>
      <?php endif; ?>
    </div>

    <div class="review-list">
      <?php if ($totalReviews == 0): ?>
        <p class="muted">No reviews yet. Be the first!</p>
      <?php endif; ?>

      <?php while($r = $reviews->fetch_assoc()): ?>
        <div class="review-item">
          <div class="review-header-item">
            <span class="reviewer-name"><?= htmlspecialchars($r['username']) ?></span>
            <span class="review-rating">
              <?= str_repeat("★", (int)$r['rating']) . str_repeat("☆", 5 - (int)$r['rating']); ?>
            </span>
          </div>

          <p class="review-text"><?= nl2br(htmlspecialchars($r['comment'])) ?></p>
          <span class="review-date"><?= date("d M Y", strtotime($r['created_at'])) ?></span>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</main>

<!-- Login Modal -->
<div class="login-modal" id="loginModal">
  <div class="modal-content">
    <h3>Login Required</h3>
    <p>Please log in to save places to your list and leave reviews</p>
    <div class="modal-buttons">
      <a href="../Sites/login.php" class="btn-modal btn-login">Log In</a>
      <button class="btn-modal btn-cancel" onclick="hideLoginModal()">Cancel</button>
    </div>
  </div>
</div>

<!-- Review Modal -->
<div id="reviewFormContainer" class="review-modal" aria-hidden="true">
  <div class="modal-box" role="dialog" aria-modal="true" aria-labelledby="reviewTitle">
    <button type="button" class="modal-close" aria-label="Close review form" onclick="closeReviewForm()">✕</button>

    <h3 id="reviewTitle">Write a Review</h3>

    <form action="../Scripts/add_review.php" method="POST" class="review-form">
      <input type="hidden" name="placeID" id="review-placeID" value="<?php echo $placeID; ?>">

    <div class="field">
        <label>Rating</label>

        <input type="hidden" name="rating" id="ratingValue" value="0" required>

        <div class="star-rating" role="radiogroup" aria-label="Choose rating">
            <button type="button" class="star" data-value="1" aria-label="1 star" aria-checked="false">★</button>
            <button type="button" class="star" data-value="2" aria-label="2 stars" aria-checked="false">★</button>
            <button type="button" class="star" data-value="3" aria-label="3 stars" aria-checked="false">★</button>
            <button type="button" class="star" data-value="4" aria-label="4 stars" aria-checked="false">★</button>
            <button type="button" class="star" data-value="5" aria-label="5 stars" aria-checked="false">★</button>

            <span class="star-hint" id="starHint">Select a rating</span>
        </div>

  <p class="field-help">Click a star to rate. You can change it anytime before submitting.</p>
</div>


      <div class="field">
        <label for="comment">Comment</label>
        <textarea id="comment" name="comment" required placeholder="What did you like? Any tips for others?"></textarea>
      </div>

      <div class="modal-actions">
        <button type="submit" class="modal-btn submit">Submit Review</button>
        <button type="button" class="modal-btn cancel" onclick="closeReviewForm()">Cancel</button>
      </div>
    </form>
  </div>
</div>
</body>
<?php include __DIR__ . "/../partials/footer.php"; ?>

</html>