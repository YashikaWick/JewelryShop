<?php
include 'db.php';

$category = $_GET['category'];

$sql = "SELECT * FROM item WHERE category='$category'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<div class='product-item'>";
    echo "<img src='" . $row['image_path'] . "' alt='" . $row['name'] . "' class='item_image'>";
    echo "<h4>" . $row['name'] . "</h4>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>Rs." . $row['price'] . ".00</p>";
    echo "<form action='cart.php' method='post'>";
    echo "<input type='hidden' name='item_id' value='" . $row['item_id'] . "'>";
    echo "<input type='hidden' name='name' value='" . $row['name'] . "'>";
    echo "<input type='hidden' name='price' value='" . $row['price'] . "'>";
    echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
    echo "</form>";
    echo "</div>";
}
$conn->close();
?>
