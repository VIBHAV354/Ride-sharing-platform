<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "cca";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['password']) { 
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid email or password. Please try again.";
        }
    } else {
        echo "Invalid email or password. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>
