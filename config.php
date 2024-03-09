<?php

$conn = mysqli_connect("localhost", "root", "1234", "yoga_db");

if (mysqli_connect_error()) {
    echo "Fail to connect: " . mysqli_connect_error();
}