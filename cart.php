<?php
session_start();
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add item to cart
    $item = [
        'item_id' => $item_id,
        'name' => $name,
        'price' => $price,
    ];
    $_SESSION['cart'][] = $item;

    // Redirect to cart page
    header("Location: cart.html");
    exit();
}
