<?php
// Connect to database
$conn = new mysqli("localhost", "root", "Root123!@#", "discoverly");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

echo "Starting fresh insert...<br><br>";

// 1. Insert a test user
$conn->query("INSERT INTO Users (userID, username, email, password) 
VALUES (1, 'john_doe', 'john@test.com', 'password123')");
echo "✅ User created! ID: 1<br>";

// 2. Castle Hill - ID 1
$conn->query("
INSERT INTO Place (placeID, userID, type, name, location, about, address, hours, price, contact, website, accessibility, duration, photos) 
VALUES 
(1, 1, 'Historic Sight', 'Castle Hill', 1, 
'picka ti mater', 
'Castle Hill Road 1, Old Town', 
'Daily 9:00 AM - 6:00 PM', 
12, 
'+386 1 234 5678', 
'www.castlehill.com', 
'Partial wheelchair access', 
3, 
'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=1600')
");
echo "✅ Castle Hill created! ID: 1<br>";

// 3. The Old Town Tavern - ID 2
$conn->query("
INSERT INTO Place (placeID, userID, type, name, location, about, address, hours, price, contact, website, accessibility, duration, photos) 
VALUES 
(2, 1, 'Restaurant', 'The Old Town Tavern', 2, 
'Family-run restaurant serving traditional dishes for three generations.', 
'Old Town Square 5', 
'Daily 11:00 AM - 11:00 PM', 
25, 
'+386 1 999 1111', 
'www.oldtowntavern.com', 
'Full wheelchair access', 
2, 
'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600')
");
echo "✅ Old Town Tavern created! ID: 2<br>";

// 4. The Alchemist's Café - ID 3
$conn->query("
INSERT INTO Place (placeID, userID, type, name, location, about, address, hours, price, contact, website, accessibility, duration, photos) 
VALUES 
(3, 1, 'Café', 'The Alchemist\'s Café', 3, 
'Cozy cellar café famous for homemade pastries and artisan hot chocolate.', 
'Cellar Street 12', 
'Monday-Saturday 8:00 AM - 8:00 PM', 
10, 
'+386 1 222 3333', 
'www.alchemistcafe.com', 
'Limited access (stairs to cellar)', 
1, 
'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600')
");
echo "✅ Alchemist's Café created! ID: 3<br>";

// 5. National Gallery - ID 4
$conn->query("
INSERT INTO Place (placeID, userID, type, name, location, about, address, hours, price, contact, website, accessibility, duration, photos) 
VALUES 
(4, 1, 'Museum', 'National Gallery', 4, 
'Extensive collection of local and international art from medieval to modern.', 
'Museum Square 1', 
'Tuesday-Sunday 10:00 AM - 6:00 PM', 
15, 
'+386 1 444 5555', 
'www.nationalgallery.com', 
'Full wheelchair access', 
3, 
'https://images.unsplash.com/photo-1565098772267-60af42b81ef2?w=600')
");
echo "✅ National Gallery created! ID: 4<br>";

// 6. Monastery Gardens - ID 5
$conn->query("
INSERT INTO Place (placeID, userID, type, name, location, about, address, hours, price, contact, website, accessibility, duration, photos) 
VALUES 
(5, 1, 'Park', 'Monastery Gardens', 5, 
'Hidden botanical gardens with rare herbs and peaceful meditation labyrinth.', 
'Monastery Road 8', 
'Daily 7:00 AM - 7:00 PM', 
0, 
'+386 1 666 7777', 
'www.monasterygardens.com', 
'Partial access (gravel paths)', 
2, 
'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600')
");
echo "✅ Monastery Gardens created! ID: 5<br>";

// 7. Insert reviews
$conn->query("
INSERT INTO Review (userID, placeID, comment, rating) 
VALUES 
(1, 1, 'Amazing place!', 5),
(1, 1, 'Pretty crowded.', 4),
(1, 2, 'Best traditional food in town!', 5),
(1, 3, 'Love their hot chocolate!', 5),
(1, 4, 'Beautiful art collection.', 4),
(1, 5, 'So peaceful and beautiful.', 5)
");
echo "✅ Reviews created!<br><br>";

echo "<h3>🎉 Success! Visit your pages:</h3>";
echo "<a href='page_layout.php?placeID=1'>Castle Hill</a><br>";
echo "<a href='page_layout.php?placeID=2'>Old Town Tavern</a><br>";
echo "<a href='page_layout.php?placeID=3'>Alchemist's Café</a><br>";
echo "<a href='page_layout.php?placeID=4'>National Gallery</a><br>";
echo "<a href='page_layout.php?placeID=5'>Monastery Gardens</a><br>";

$conn->close();
?>