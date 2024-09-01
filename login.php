<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_type'] = $row['user_type'];

            if($row['user_type'] == 'admin'){
                header("Location: admin.html");    
            }
            else if($row['user_type'] == 'user'){
                header("Location: index.html");    
            }
            else {
                echo "Invalid user type.";
            }
            exit();
        
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }
}
$conn->close();
?>
