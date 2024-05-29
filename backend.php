<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = isset($_POST['Name']) ? $_POST['Name'] : '';
    $MobileNumber = isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : '';
    $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
    $Message = isset($_POST['Message']) ? $_POST['Message'] : '';

    if (!empty($Name) && !empty($Email) && !empty($MobileNumber) && !empty($Message)) {
        $conn = new mysqli("localhost", "root", "", "myPortfolio");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO clients (Name, Contact, Email,  Message) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssss", $Name, $MobileNumber, $Email, $Message);

        if ($stmt->execute()) {
            echo "Thank you for contacting us. We'll get back to you as soon as possible.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Please fill in all fields.";
    }
} else {
    echo "Form not submitted due to  some error.";
}
?>
