<?php
include 'db.php';
session_start();

// if ($_SESSION['user_type'] != 'admin') {
//     header("Location: index.html");
// }

$editItem = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $image_path = "images/" . basename($_FILES["image"]["name"]);

        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

        $sql = "INSERT INTO item (name, description, category, price, image_path) VALUES ('$name', '$description', '$category', '$price', '$image_path')";
        $conn->query($sql);

        header("Location: admin.html");

    } elseif (isset($_POST['update'])) {

        $item_id = $_POST['item_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        
        
        if (!empty($_FILES["image"]["name"])) {
            $image_path = "images/" . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
            $sql = "UPDATE item SET name='$name', description='$description', category='$category', price='$price', image_path='$image_path' WHERE item_id='$item_id'";
        } else {
            $sql = "UPDATE item SET name='$name', description='$description', category='$category', price='$price' WHERE item_id='$item_id'";
        }

        $conn->query($sql);

        header("Location: admin.html");

    } elseif (isset($_POST['delete'])) {

        $item_id = $_POST['item_id'];
        $sql = "DELETE FROM item WHERE item_id='$item_id'";
        $conn->query($sql);

        header("Location: admin.html");

    } 
}

// Displaying existing items
$sql = "SELECT * FROM item";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<div class='existing-item'>";
    echo "<br>";
    echo "<p>" . $row['item_id'] . ".&nbsp;</><br>";
    echo "<p style='font-weight:bold;'>" . $row['name'] . "</><br>";
    echo "<p style='font-style:italic;'>" . $row['description'] . "</p><br>";
    echo "<p>Rs. " . $row['price'] . ".00</p><br>";
    echo "</div>";
}
$conn->close();



?>


