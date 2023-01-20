<?php

$conn = mysqli_connect('localhost:3306','root','','school');

if (!$conn) {
    die("Connection Faied " . $conn->connect_error);
  } 
?>