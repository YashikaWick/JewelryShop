<?php
session_start();
include 'db.php';

$user_id = 2;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['add_to_cart'])) {
        $item_id = $_POST['item_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];       
       
        $sql = "INSERT INTO cart (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', 1)";
        
        $conn->query($sql);

        
        header("Location: cart.html");
        exit();

    } elseif (isset($_POST['update_quantity'])) {
        $item_id = $_POST['item_id'];
        $quantity = $_POST['quantity'];

        // Update the quantity of the item in the cart
        $sql = "UPDATE cart SET quantity = '$quantity' WHERE user_id='$user_id' AND item_id='$item_id'";
        $conn->query($sql);

        
        header("Location: cart.html");
        exit();

    } elseif (isset($_POST['delete_from_cart'])) {
        $item_id = $_POST['item_id'];

        // Delete the item from the cart
        $sql = "DELETE FROM cart WHERE user_id='$user_id' AND item_id='$item_id'";
        $conn->query($sql);

        
        header("Location: cart.html");
        exit();
    }
}

// Display cart items
$sql = "SELECT item_id, name, price from item where item_id IN(SELECT item_id FROM cart)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='cart-item'>";
        echo "<h4>" . $row['name'] . "</h4>";
        echo "<p>Rs." . $row['price'] . ".00</p>";
        echo "<form class='cart-form' action='cart.php' method='post'>";
        echo "<input type='hidden' name='item_id' value='" . $row['item_id'] . "'>";
        // echo "<input type='number' name='quantity' value='" . $row['quantity'] . "' min='1'>";
        // echo "<button type='submit' name='update_quantity'>Update Quantity</button>";
        echo "<button type='submit' name='delete_from_cart' onclick='return confirm(\"Are you sure you want to remove this item from the cart?\");'>Delete</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p>Your cart is empty.</p>";
}

$conn->close();
?>