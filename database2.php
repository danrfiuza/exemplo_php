<?php

$servername = "localhost:3306";
$username = "root";
$password = "08072012";

function conectar($servername,$username,$password) {
    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
}

conectar($servername,$username,$password);



?> 