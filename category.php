<?php
include 'db.php';

$category = $_GET['category'];

$sql = "SELECT * FROM jewelry WHERE category='$category'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<img src='" . $row['image_path'] . "' alt='" . $row['name'] . "'>";
    echo "<h2>" . $row['name'] . "</h2>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>$" . $row['price'] . "</p>";
    echo "<a href='buy.php?id=" . $row['jewelry_id'] . "'>Buy Now</a>";
    echo "</div>";
}
$conn->close();
?>
