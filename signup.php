<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ss", $email, $password); 

        if ($stmt->execute()) {

            header("Location: home.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
