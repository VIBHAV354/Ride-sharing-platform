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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_term'])) {
        $search_term = $_POST['search_term'];

        // Note: Use a placeholder (?) for search_term in the SQL query
        $sql = "SELECT * FROM offer_ride WHERE destination LIKE ?";
        $stmt = $conn->prepare($sql);
        
        // Bind the search parameter separately
        $search_param = "%{$search_term}%";
        $stmt->bind_param("s", $search_param);
        
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "Name: " . $row["name"]."<br>". "  Mobile Number: " . $row["mobile_number"]."<br>". " Starting Point: " . $row["starting_point"]."<br>". "  Destination: " . $row["destination"]."<br>". "  Time: " . $row["time"]."<br>". "  Date: " . $row["date"]. "<hr>";
            }
        } else {
            echo "0 results found for '{$search_term}'";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
