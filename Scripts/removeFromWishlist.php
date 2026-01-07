<?php
session_start();
require "Config.php";

if (!isset($_SESSION['userID'])) {
    header("Location: ../Sites/login.php");
    exit;
}

$userID = $_SESSION['userID'];
$placeID = (int)$_POST['placeID'];

$sql = "DELETE FROM Wishlist WHERE userID = ? AND placeID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userID, $placeID);
$stmt->execute();

header("Location: ../pages-layout/page_layout.php?placeID=$placeID");
exit;
