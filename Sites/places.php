<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Places to Visit - Discoverly</title>

  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/places.css">
  <script src="../Scripts/base.js" defer></script>
</head>

<body>
  <div class="site-wrapper">

    <?php
      $current = 'Places';
      $pill = 'Places';
      include __DIR__ . "/../partials/header_sites.php";
    ?>

    <main>
      <div class="page-title">
        <h2>Places to Visit</h2>
        <p>Discover the best spots in town</p>
      </div>

      <div class="search-section">
        <input
          type="text"
          class="search-bar"
          placeholder="Search places..."
          id="search-bar"
          onkeyup="search()"
        >
      </div>

      <div class="categories" id="myBtnContainer">
        <input type="hidden" id="sortSelectHidden" value="az">

        <div class="sort-wrapper">
          <button class="sort-btn" onclick="toggleSortMenu()">
          <img src="https://cdn-icons-png.flaticon.com/128/1159/1159884.png" alt="Sort" class="sort-icon">
          </button>

          <div class="sort-menu" id="sortMenu">
            <button onclick="setSort('az')">Name (A-Z)</button>
            <button onclick="setSort('za')">Name (Z-A)</button>
          </div>
        </div>
        
        <button class="category-btn active" onclick="filterSelection('all')">Show all</button>
        <button class="category-btn" onclick="filterSelection('restaurants')">Restaurants</button>
        <button class="category-btn" onclick="filterSelection('cafes')">Cafes</button>
        <button class="category-btn" onclick="filterSelection('historic-sights')">Historic Sights</button>
        <button class="category-btn" onclick="filterSelection('museums')">Museums</button>
        <button class="category-btn" onclick="filterSelection('parks')">Parks</button>
      </div>

      <div class="places-grid">
        <?php
        $sql = "SELECT placeID, name, type, about, photos FROM Place WHERE type != 'Activity'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $placeID = htmlspecialchars($row['placeID']);
                $name = htmlspecialchars($row['name']);
                $type = htmlspecialchars($row['type']);
                $about = htmlspecialchars($row['about']);

                $typeNormalized = strtolower(str_replace('é', 'e', $type));

                if (stripos($type, 'historic') !== false) {
                    $typeNormalized = 'historic';
                    $typeClass = 'historic-sights';
                } else {
                    $typeClass = $typeNormalized . 's';
                }
                
                $photos = $row['photos'];
                $photoArray = !empty($photos) ? explode(',', $photos) : [];
                $firstPhoto = !empty($photoArray[0]) ? $photoArray[0] : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600';

                $shortAbout = strlen($about) > 100 ? substr($about, 0, 100) . '...' : $about;
                
                echo "
                <a href=\"../pages-layout/page_layout.php?placeID={$placeID}\" class=\"place-card filterDiv {$typeClass} show\" data-category=\"{$typeNormalized}\">
                  <img src=\"{$firstPhoto}\" alt=\"{$name}\" class=\"place-image\">
                  <div class=\"place-content\">
                    <h3>{$name}</h3>
                    <p>{$shortAbout}</p>
                    <span class=\"place-category\">{$type}</span>
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
