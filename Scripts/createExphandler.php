<?php
session_start();
include "Config.php";

if (!isset($_SESSION['userID'])) {
    header("Location: ../login.php?error=loginrequired");
    exit();
}

$name = $_POST['name'];
$type = $_POST['type'];
$about = $_POST['about'];
$address = $_POST['address'];
$hours = $_POST['hours'];
$price = $_POST['price'];
$contact = $_POST['contact'];
$website = $_POST['website'];
$accessibility = $_POST['accessibility'];
$duration = $_POST['duration'];


$photoPaths = [];

if (!empty($_FILES['photos']['name'][0])) {

    $uploadDir = "../uploads_places/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {

        $fileName = time() . "_" . basename($_FILES['photos']['name'][$key]);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($tmpName, $filePath)) {
            $photoPaths[] = "uploads_places/" . $fileName;
        }
    }
}

$photos_string = implode(",", $photoPaths);

$user_id = $_SESSION['userID'];

$sql = "INSERT INTO Place (userID, type, name, location, about, address, hours, price, contact, website, accessibility, duration, photos)
        VALUES (?, ?, ?, NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssisssis",
    $user_id,
    $type,
    $name,
    $about,
    $address,
    $hours,
    $price,
    $contact,
    $website,
    $accessibility,
    $duration,
    $photos_string
);

if ($stmt->execute()) {
    header("Location: ../Sites/places.php?created=1");
    exit();
} else {
    die("Database error: " . $stmt->error);
}
?>

