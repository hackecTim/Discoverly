
<?php
session_start();
include "../Scripts/Config.php";
/*
if (!isset($_GET['placeID'])) {
    die("Missing place ID");
}
*/
$placeID = 1;//intval($_GET['placeID']);


$sql = "SELECT Review.*, Users.username
        FROM Review
        JOIN Users ON Review.userID = Users.userID
        WHERE Review.placeID = ?
        ORDER BY Review.reviewID DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $placeID);
$stmt->execute();
$reviews = $stmt->get_result();


$sql2 = "SELECT AVG(rating) AS avgRating, COUNT(*) AS totalReviews FROM Review WHERE placeID = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $placeID);
$stmt2->execute();
$ratingData = $stmt2->get_result()->fetch_assoc();

$avgRating = $ratingData['avgRating'] ? number_format($ratingData['avgRating'], 1) : "0.0";
$totalReviews = $ratingData['totalReviews'];

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
/*


if (!isset($_GET['id'])) {
    die("Missing place ID");
}

$placeID = intval($_GET['id']);


$sql = "SELECT Review.*, User.username
        FROM Review
        JOIN User ON Review.userID = User.user_id
        WHERE Review.placeID = ?
        ORDER BY Review.reviewID DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $placeID);
$stmt->execute();
$reviews = $stmt->get_result();


$sql2 = "SELECT AVG(rating) AS avgRating, COUNT(*) AS totalReviews FROM Review WHERE placeID = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $placeID);
$stmt2->execute();
$ratingData = $stmt2->get_result()->fetch_assoc();

$avgRating = $ratingData['avgRating'] ? number_format($ratingData['avgRating'], 1) : "0.0";
$totalReviews = $ratingData['totalReviews'];*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Castle Hill - Discoverly</title>
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
.hero-image {
width: 100%;
height: 400px;
object-fit: cover;
background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8a 100%);
}
main {
max-width: 1400px;
margin: 0 auto;
padding: 2rem 4rem 4rem;
}
.detail-header {
display: flex;
justify-content: space-between;
align-items: start;
margin-bottom: 2rem;
}
.title-section h2 {
font-size: 2.5rem;
color: var(--accent-color);
margin-bottom: 0.5rem;
}
.category-tag {
display: inline-block;
padding: 0.4rem 1rem;
background-color: var(--bg-color);
color: var(--accent-color);
border-radius: 20px;
font-size: 0.9rem;
font-weight: 500;
}
.btn-save {
padding: 0.8rem 2rem;
background-color: var(--accent-color);
color: white;
border: none;
border-radius: 8px;
font-weight: 600;
cursor: pointer;
transition: background 0.3s ease;
font-size: 1rem;
}
.btn-save:hover {
background-color: #25497a;
}
.btn-save.disabled {
background-color: #ccc;
cursor: not-allowed;
}
.content-grid {
display: grid;
grid-template-columns: 1fr 1fr;
gap: 2rem;
margin-bottom: 3rem;
}
.map-section {
}
.map-card {
background-color: var(--card-bg);
border-radius: 12px;
padding: 2rem;
box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}
.map-card h3 {
font-size: 1.5rem;
color: var(--accent-color);
margin-bottom: 0.5rem;
}
#map { height: 500px; }
.info-side {
background-color: var(--card-bg);
border-radius: 12px;
padding: 2rem;
box-shadow: 0 4px 8px rgba(0,0,0,0.05);
display: flex;
flex-direction: column;
gap: 2rem;
}
.photos-section {
margin-bottom: 3rem;
}
.photo-gallery {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
gap: 1rem;
}
.gallery-photo {
width: 100%;
height: 200px;
object-fit: cover;
border-radius: 8px;
transition: transform 0.2s ease;
cursor: pointer;
}
.gallery-photo:hover {
transform: scale(1.05);
}
.main-content {
background-color: var(--card-bg);
border-radius: 12px;
padding: 2rem;
box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}
.info-section {
margin-bottom: 2rem;
}
.info-section h3 {
font-size: 1.5rem;
color: var(--accent-color);
margin-bottom: 1rem;
}
.info-section p {
color: #555;
line-height: 1.8;
}
.info-item {
display: flex;
align-items: start;
gap: 0.8rem;
margin-bottom: 0.8rem;
}
.info-icon {
color: var(--accent-color);
font-size: 1.2rem;
margin-top: 0.2rem;
}
.sidebar {
display: flex;
flex-direction: column;
gap: 2rem;
}
.sidebar-card {
background-color: var(--card-bg);
border-radius: 12px;
padding: 1.5rem;
box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}
.sidebar-card h3 {
font-size: 1.2rem;
color: var(--accent-color);
margin-bottom: 1rem;
}
.sidebar {
display: flex;
flex-direction: column;
gap: 2rem;
}
.sidebar-card {
background-color: var(--card-bg);
border-radius: 12px;
padding: 1.5rem;
box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}
.sidebar-card h3 {
font-size: 1.2rem;
color: var(--accent-color);
margin-bottom: 1rem;
}
.reviews-section {
background-color: var(--card-bg);
border-radius: 12px;
padding: 2rem;
box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}
.reviews-header {
display: flex;
justify-content: space-between;
align-items: center;
margin-bottom: 2rem;
}
.reviews-header h3 {
font-size: 1.8rem;
color: var(--accent-color);
}
.overall-rating {
display: flex;
align-items: center;
gap: 1rem;
}
.rating-number {
font-size: 2.5rem;
font-weight: 700;
color: var(--accent-color);
}
.rating-stars {
font-size: 1.5rem;
color: #ffa726;
}
.rating-count {
color: #666;
font-size: 0.9rem;
}
.btn-review {
padding: 0.8rem 1.5rem;
background-color: var(--accent-color);
color: white;
border: none;
border-radius: 8px;
font-weight: 600;
cursor: pointer;
transition: background 0.3s ease;
}
.btn-review:hover {
background-color: #25497a;
}
.btn-review.disabled {
background-color: #ccc;
cursor: not-allowed;
}
.review-list {
display: flex;
flex-direction: column;
gap: 1.5rem;
}
.review-item {
padding: 1.5rem;
background-color: var(--bg-color);
border-radius: 8px;
}
.review-header-item {
display: flex;
justify-content: space-between;
align-items: center;
margin-bottom: 0.8rem;
}
.reviewer-name {
font-weight: 600;
color: var(--text-color);
}
.review-rating {
color: #ffa726;
font-size: 1.1rem;
}
.review-text {
color: #555;
line-height: 1.7;
margin-bottom: 0.5rem;
}
.review-date {
font-size: 0.85rem;
color: #999;
}
.login-modal {
display: none;
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.5);
z-index: 1000;
justify-content: center;
align-items: center;
}
.login-modal.show {
display: flex;
}
.modal-content {
background-color: var(--card-bg);
border-radius: 12px;
padding: 2.5rem;
max-width: 400px;
text-align: center;
box-shadow: 0 8px 24px rgba(0,0,0,0.2);
}
.modal-content h3 {
font-size: 1.5rem;
color: var(--accent-color);
margin-bottom: 1rem;
}
.modal-content p {
color: #666;
margin-bottom: 1.5rem;
}
.modal-buttons {
display: flex;
gap: 1rem;
justify-content: center;
}
.btn-modal {
padding: 0.8rem 1.5rem;
border: none;
border-radius: 8px;
font-weight: 600;
cursor: pointer;
transition: all 0.3s ease;
}
.btn-login {
background-color: var(--accent-color);
color: white;
}
.btn-login:hover {
background-color: #25497a;
}
.btn-cancel {
background-color: var(--bg-color);
color: var(--text-color);
}
.btn-cancel:hover {
background-color: #e0ddd8;
}
@media (max-width: 968px) {
.content-grid {
grid-template-columns: 1fr;
}
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
.hero-image {
height: 250px;
}
.detail-header {
flex-direction: column;
gap: 1rem;
}
.title-section h2 {
font-size: 2rem;
}
}
.review-modal {
    display: none; /* hidden by default */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.review-modal .modal-box {
    background: #ffffff;
    padding: 2rem;
    width: 420px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    font-family: "Inter", sans-serif;
}

.review-modal h3 {
    font-size: 1.5rem;
    color: #1e3a5f;
    margin-bottom: 1rem;
}

.review-modal label {
    font-weight: 600;
    color: #333;
    margin-top: 1rem;
    display: block;
}

.review-modal select,
.review-modal textarea {
    width: 100%;
    padding: 0.7rem;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 0.95rem;
    margin-top: 0.3rem;
    font-family: inherit;
}

.review-modal textarea {
    height: 120px;
    resize: vertical;
}

.review-modal .modal-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 1.5rem;
}

.modal-btn {
    padding: 0.7rem 1.4rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.25s ease;
    font-family: inherit;
}

.modal-btn.submit {
    background: #1e3a5f;
    color: white;
}

.modal-btn.submit:hover {
    background: #25497a;
}

.modal-btn.cancel {
    background: #f0efeb;
    color: #333;
}

.modal-btn.cancel:hover {
    background: #e1dfd9;
}
</style>
</head>
<body>
<header>
    <h1>Discoverly</h1>
    <nav>
        <a href="../Sites/about.php">About</a>

        <?php if (isset($_SESSION['userID'])): ?>
            <a href="../Sites/user-profile.php">My Profile</a>
            <a href="../Scripts/logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
            <a href="../Sites/login.php">Login</a>
         
        <?php endif; ?>
    </nav>
  </header>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
crossorigin=""></script>

<img src="https://images.unsplash.com/photo-1464207687429-7505649dae38?w=1600" alt="Castle Hill" class="hero-image">

<main>
<div class="detail-header">
<div class="title-section">
<h2>Castle Hill</h2>
<span class="category-tag">Historic Sight</span>
</div>
<button class="btn-save" onclick="showLoginModal()">Add to My List</button>
</div>

<div class="content-grid">
<div class="map-section">
<div class="map-card">
<h3>Location</h3>
<p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">Castle Hill Road 1, Old Town</p>
<div id="map">
</div>
<button class="btn-save" style="margin-top:1rem;" onclick="showUserLocation()">Show my location</button>
<button class="btn-save" style="margin-top:0.5rem;" onclick="routeToLocation()">Show directions</button>
</div>
</div>

<div class="info-side">
<div class="info-section">
<h3>About</h3>
<p>A stunning medieval fortress perched atop the highest hill in the old town, Castle Hill offers breathtaking panoramic views of the entire city and surrounding countryside. Originally built in the 13th century as a defensive stronghold, the castle has been meticulously preserved and now houses a fascinating museum showcasing the region's rich history.</p>
<p>Visitors can explore the castle's towers, walk along the ancient ramparts, and discover hidden courtyards. The on-site museum features archaeological finds, medieval weapons, and interactive exhibits that bring history to life.</p>
</div>

<div class="info-section">
<h3>Quick Info</h3>
<div class="info-item">
<span class="info-icon"></span>
<span><strong>Address:</strong> Castle Hill Road 1, Old Town</span>
</div>
<div class="info-item">
<span class="info-icon"></span>
<span><strong>Hours:</strong> Daily 9:00 AM - 6:00 PM (Apr-Oct), 10:00 AM - 4:00 PM (Nov-Mar)</span>
</div>
<div class="info-item">
<span class="info-icon"></span>
<span><strong>Price:</strong> €12 adults, €6 students, Free under 12</span>
</div>
<div class="info-item">
<span class="info-icon"></span>
<span><strong>Contact:</strong> +386 1 234 5678</span>
</div>
<div class="info-item">
<span class="info-icon"></span>
<span><strong>Website:</strong> <a href="#" style="color: var(--accent-color);">www.castlehill.com</a></span>
</div>
<div class="info-item">
<span class="info-icon"></span>
<span><strong>Accessibility:</strong> Partial wheelchair access, elevator to main courtyard</span>
</div>
<div class="info-item">
<span class="info-icon"></span>
<span><strong>Rating:</strong> 4.8 average</span>
</div>
<div class="info-item">
<span class="info-icon"></span>
<span><strong>Duration:</strong> Allow 2-3 hours</span>
</div>
</div>
</div>
</div>

<div class="photos-section">
<h3 style="font-size: 1.5rem; color: var(--accent-color); margin-bottom: 1.5rem;">Photos</h3>
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

<div class="rating-stars">
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
    <p style="color:#777;">No reviews yet. Be the first!</p>
<?php endif; ?>

<?php while($r = $reviews->fetch_assoc()): ?>
    <div class="review-item">
        <div class="review-header-item">
            <span class="reviewer-name"><?= htmlspecialchars($r['username']) ?></span>
            <span class="review-rating">
                <?= str_repeat("★", $r['rating']) . str_repeat("☆", 5 - $r['rating']); ?>
            </span>
        </div>

        <p class="review-text"><?= nl2br(htmlspecialchars($r['comment'])) ?></p>
        <span class="review-date">
            <?= date("d M Y", strtotime($r['created_at'])) ?>
        </span>
    </div>
<?php endwhile; ?>
</div>

</div>
</main>

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
<div id="reviewFormContainer" class="review-modal">
    <div>
        <h3>Write a Review</h3>
        
        <form action="../Scripts/add_review.php" method="POST">
            <input type="hidden" name="placeID" id="review-placeID" value="<?php echo $placeID; ?>">

            <label>Rating:</label>
            <select name="rating" required>
                <option value="5">★★★★★</option>
                <option value="4">★★★★☆</option>
                <option value="3">★★★☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="1">★☆☆☆☆</option>
            </select>

            <label>Comment:</label>
            <textarea name="comment" required></textarea>

            <button type="submit">Submit Review</button>
            <button type="button" onclick="closeReviewForm()">Cancel</button>
        </form>
    </div>
</div>
<script src="page_layout.js" defer></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script src="page_layout.js"></script>
</body>
</html>
