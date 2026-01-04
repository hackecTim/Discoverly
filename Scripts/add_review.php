<?php
session_start();
include "Config.php";

if (!isset($_SESSION['userID'])) {
    header("Location: ../Sites/login.php?error=login_required");
    exit();
}

$userID = $_SESSION['userID'];
$placeID = intval($_POST['placeID']);
$rating = intval($_POST['rating']);
$comment = trim($_POST['comment']);
$placeID = 1;
if ($rating < 1 || $rating > 5) {
    header("Location: ../Sites/place-detail.php?id=$placeID&error=invalid_rating");
    exit();
}

$sql = "INSERT INTO Review (userID, placeID, rating, comment) VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiis", $userID, $placeID, $rating, $comment);
$stmt->execute();

header("Location: ../pages-layout/page_layout.php?id=$placeID&review=success");
exit();
?>

