<?php
session_start();
require "Config.php";

if (!isset($_SESSION['userID'])) {
    header("Location: ../Sites/login.php");
    exit;
}

$userID = $_SESSION['userID'];
$placeID = (int)$_POST['placeID'];

$sql = "INSERT IGNORE INTO Wishlist (userID, placeID) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userID, $placeID);
$stmt->execute();

header("Location: ../pages-layout/page_layout.php?placeID=$placeID");
exit;
