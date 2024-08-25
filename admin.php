<?php
include 'db.php';
session_start();

if ($_SESSION['user_type'] != 'admin') {
    header("Location: index.html");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $image_path = "images/" . basename($_FILES["image"]["name"]);

        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

        $sql = "INSERT INTO jewelry (name, description, category, price, image_path) VALUES ('$name', '$description', '$category', '$price', '$image_path')";
        $conn->query($sql);
    } elseif (isset($_POST['update'])) {
        // Update logic
    } elseif (isset($_POST['delete'])) {
        // Delete logic
    }
}

// Displaying existing items
$sql = "SELECT * FROM jewelry";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h2>" . $row['name'] . "</h2>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>$" . $row['price'] . "</p>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='jewelry_id' value='" . $row['jewelry_id'] . "'>";
    echo "<input type='submit' name='delete' value='Delete'>";
    echo "</form>";
    echo "</div>";
}
$conn->close();
?>
