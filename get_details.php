<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "cca"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $starting_point = $_POST['starting_point'];
    $destination = $_POST['destination'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    
    if (empty($name) || empty($mobile_number) || empty($starting_point) || empty($destination) || empty($time) || empty($date)) {
        echo "Error: Please fill in all required fields";
        exit;
    }

    $sql = "INSERT INTO offer_ride (name, mobile_number, starting_point, destination, time, date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssss", $name, $mobile_number, $starting_point, $destination, $time, $date);

    if ($stmt->execute()) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

?>
