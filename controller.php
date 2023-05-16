<?php
include 'model.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numbersString = $_POST["numbersInput"];
    $results = calculateSquares($numbersString);
    include 'view.php';
}
