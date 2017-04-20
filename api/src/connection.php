<?php

require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_errno) {
    die("Can not connect to database: " . $conn->connect_error);
}
