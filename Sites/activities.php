<?php
session_start();
include "../Scripts/Config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Activities - Discoverly</title>

  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/activities.css">
    <script src="../Scripts/base.js" defer></script>

</head>

<body>
  <div class="site-wrapper">
    <?php
      $current = 'Activities';
      $pill = 'Activities';
      include __DIR__ . "/../partials/header_sites.php";
    ?>
    <main>
      <div class="page-title">
        <h2>Activities & Events</h2>
        <p>Discover what's happening around town</p>
      </div>

      <div class="search-section">
        <input
          type="text"
          class="search-bar"
          placeholder="Search activities..."
          id="search-bar"
          onkeyup="search()"
        >
      </div>

      <div class="categories" id="myBtnContainer">
        <button class="category-btn active" onclick="filterSelection('all')">All</button>
      </div>

      <div class="activities-grid">
        <?php
        $sql = "SELECT placeID, name, about, price, photos FROM Place WHERE type = 'Activity'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $placeID = htmlspecialchars($row['placeID']);
                $name = htmlspecialchars($row['name']);
                $about = htmlspecialchars($row['about']);
                $price = htmlspecialchars($row['price']);
                
                $photos = $row['photos'];
                $photoArray = !empty($photos) ? explode(',', $photos) : [];
                $firstPhoto = !empty($photoArray[0]) ? $photoArray[0] : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600';

                $shortAbout = strlen($about) > 100 ? substr($about, 0, 100) . '...' : $about;

                if ($price == "0" || empty($price)) {
                  $priceClass = "activity-price free";
                  $priceDisplay = "Free";
              } else {
                  $priceClass = "activity-price";
                  $priceDisplay = htmlspecialchars($price);
              }
                
                echo "
                <a href=\"../pages-layout/page_layout.php?placeID={$placeID}\" class=\"activity-card\">
                  <img src=\"{$firstPhoto}\" alt=\"{$name}\" class=\"activity-image\">
                  <div class=\"activity-content\">
                    <h3>{$name}</h3>
                    <p>{$shortAbout}</p>
                    <span class=\"{$priceClass}\">{$priceDisplay}</span>
                  </div>
                </a>
                ";
            }
        }
        ?>
      </div>
    </main>
<?php
    $conn->close();
    include __DIR__ . "/../partials/footer.php";
?>

  </div>

  <script src="../filter-search.js"></script>
</body>
</html>
