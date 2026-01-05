<?php
$conn = new mysqli("localhost", "root", "", "discoverly");

// creating the acitivy table as well
/*$conn->query("
CREATE TABLE IF NOT EXISTS Activity (
    activityID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    name VARCHAR(200),
    description VARCHAR(1500),
    schedule VARCHAR(300),
    duration INT,
    price VARCHAR(100),
    photos VARCHAR(2000),
    CONSTRAINT fk_activity_user
        FOREIGN KEY (userID) REFERENCES Users(userID)
        ON DELETE CASCADE
)
");*/

/*$conn->query("INSERT INTO Users (username, email, password) VALUES ('admin', 'admin@discoverly.com', 'pass123')");
$userID = $conn->insert_id;
echo "✅ User created! ID: $userID<br><br>";*/

$userID = 1;

$conn->query("
INSERT INTO Place (userID, type, name, location, about, address, hours, price, contact, website, accessibility, duration, photos, latitude, longitude) VALUES
($userID, 'Restaurant', 'The Old Town Tavern', 'Old Town', 'Family-run restaurant serving traditional dishes for three generations.', 'Old Town Square 5', 'Daily 11:00 AM - 11:00 PM', '€€', '+386 1 999 1111', 'https://www.oldtowntavern.com', 'Full wheelchair access', 2, 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600', 46.0514, 14.5060),

($userID, 'Restaurant', 'River View Bistro', 'Riverside', 'Contemporary cuisine with stunning riverside seating and seasonal menu.', 'River Walk 12', 'Daily 12:00 PM - 10:00 PM', '€€€', '+386 1 888 9999', 'https://www.riverviewbistro.com', 'Full wheelchair access', 2, 'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?w=600', 46.0503, 14.5125),

($userID, 'Restaurant', 'Grandma\'s Kitchen', 'City Center', 'Homestyle cooking in a warm atmosphere. Known for their legendary goulash.', 'Main Street 34', 'Monday-Saturday 10:00 AM - 9:00 PM', '€€', '+386 1 777 6666', 'https://www.grandmaskitchen.com', 'Limited access', 2, 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=600', 46.0520, 14.5080),

($userID, 'Café', 'The Alchemist\'s Café', 'Old Town', 'Cozy cellar café famous for homemade pastries and artisan hot chocolate.', 'Cellar Street 12', 'Monday-Saturday 8:00 AM - 8:00 PM', '€', '+386 1 222 3333', 'https://www.alchemistcafe.com', 'Limited access (stairs to cellar)', 1, 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600', 46.0512, 14.5055),

($userID, 'Café', 'Brew & Pages', 'City Center', 'Bookshop café with specialty coffee and quiet reading corners.', 'Book Lane 7', 'Daily 8:00 AM - 9:00 PM', '€€', '+386 1 333 4444', 'https://www.brewandpages.com', 'Full wheelchair access', 2, 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600', 46.0525, 14.5070),

($userID, 'Café', 'Riverside Roasters', 'Riverside', 'Waterfront café roasting their own beans. Perfect for morning walks.', 'Riverside Path 3', 'Daily 7:00 AM - 7:00 PM', '€', '+386 1 555 6666', 'https://www.riversideroasters.com', 'Full wheelchair access', 1, 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600', 46.0500, 14.5140),

($userID, 'Historic Sight', 'Castle Hill', 'Old Town', 'Medieval fortress overlooking the town with panoramic views and museum.', 'Castle Hill Road 1, Old Town', 'Daily 9:00 AM - 6:00 PM', '€€', '+386 1 234 5678', 'https://www.castlehill.com', 'Partial wheelchair access', 3, 'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=600', 46.0540, 14.5045),

($userID, 'Historic Sight', 'Dragon Bridge', 'City Center', 'Iconic Art Nouveau bridge adorned with dragon statues and local legends.', 'Dragon Square', 'Always open', 'Free', '+386 1 123 4567', 'https://www.dragonbridge.com', 'Full wheelchair access', 1, 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=600', 46.0515, 14.5100),

($userID, 'Historic Sight', 'St. Nicholas Cathedral', 'Old Town', '13th century cathedral with stunning baroque interiors and bell tower views.', 'Cathedral Square 1', 'Daily 8:00 AM - 6:00 PM', '€', '+386 1 234 8888', 'https://www.stnicholascathedral.com', 'Partial access', 2, 'https://images.unsplash.com/photo-1529655683826-aba9b3e77383?w=600', 46.0518, 14.5065),

($userID, 'Museum', 'National Gallery', 'Museum District', 'Extensive collection of local and international art from medieval to modern.', 'Museum Square 1', 'Tuesday-Sunday 10:00 AM - 6:00 PM', '€€', '+386 1 444 5555', 'https://www.nationalgallery.com', 'Full wheelchair access', 3, 'https://images.unsplash.com/photo-1565098772267-60af42b81ef2?w=600', 46.0530, 14.5090),

($userID, 'Museum', 'City History Museum', 'City Center', 'Interactive exhibits showcasing the town\'s evolution through centuries.', 'History Lane 8', 'Wednesday-Monday 9:00 AM - 5:00 PM', '€', '+386 1 666 7777', 'https://www.cityhistorymuseum.com', 'Full wheelchair access', 2, 'https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?w=600', 46.0522, 14.5075),

($userID, 'Museum', 'Museum of Contemporary Art', 'Museum District', 'Cutting-edge exhibitions featuring local and international contemporary artists.', 'Modern Street 15', 'Tuesday-Sunday 11:00 AM - 7:00 PM', '€€', '+386 1 888 9999', 'https://www.contemporaryart.com', 'Full wheelchair access', 2, 'https://images.unsplash.com/photo-1578672899664-c5c9c2b2cde4?w=600', 46.0535, 14.5095),

($userID, 'Park', 'Monastery Gardens', 'Old Town', 'Hidden botanical gardens with rare herbs and peaceful meditation labyrinth.', 'Monastery Road 8', 'Daily 7:00 AM - 7:00 PM', 'Free', '+386 1 666 7777', 'https://www.monasterygardens.com', 'Partial access (gravel paths)', 2, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600', 46.0510, 14.5050),

($userID, 'Park', 'Central Park', 'City Center', 'Large urban park with walking paths, pond, and weekend outdoor concerts.', 'Park Avenue 1', 'Daily 6:00 AM - 10:00 PM', 'Free', '+386 1 999 0000', 'https://www.centralpark.com', 'Full wheelchair access', 3, 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=600', 46.0545, 14.5110),

($userID, 'Park', 'River Walk Promenade', 'Riverside', 'Scenic riverside path lined with willow trees, perfect for morning strolls.', 'River Path 20', 'Always open', 'Free', '+386 1 111 2222', 'https://www.riverwalk.com', 'Full wheelchair access', 2, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600', 46.0495, 14.5150)
");
echo "✅ All 15 places created with coordinates!<br><br>";

/*$conn->query("
INSERT INTO Activity (userID, name, description, schedule, duration, price, photos, latitude, longitude) VALUES
($userID, 'Sunday Flea Market', 'Every Sunday 8 AM - 12 PM, vintage treasures and crafts from local vendors', 'Every Sunday 8:00 AM - 12:00 PM', 4, 'Free', 'https://images.unsplash.com/photo-1490818387583-1baba5e638af?w=600', 46.0517, 14.5105),

($userID, 'Local Food Tour', 'Taste authentic dishes at hidden local eateries with a knowledgeable guide', 'Daily 10:00 AM, 2:00 PM, 6:00 PM', 3, '€€€', 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600', 46.0513, 14.5062),

($userID, 'Riverside Bike Tour', 'Cycle along scenic trails and through old town neighborhoods', 'Daily 9:00 AM, 3:00 PM', 2, '€€', 'https://images.unsplash.com/photo-1507035895480-2b3156c31fc8?w=600', 46.0498, 14.5135),

($userID, 'Wine Cellar Visit', 'Sample regional wines in historic underground cellars with expert sommeliers', 'Tuesday-Saturday 4:00 PM, 6:00 PM', 2, '€€€', 'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?w=600', 46.0509, 14.5048)
");*/

$conn->query("
INSERT INTO Review (userID, placeID, comment, rating) VALUES
($userID, 1, 'Best traditional food in town!', 5),
($userID, 1, 'Cozy atmosphere, loved it!', 4),
($userID, 4, 'Love their hot chocolate!', 5),
($userID, 7, 'Amazing views from the castle!', 5),
($userID, 7, 'A must-visit place!', 5),
($userID, 10, 'Beautiful art collection', 4),
($userID, 13, 'So peaceful and relaxing', 5)
");


$conn->close();
?>
