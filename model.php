<?php
function calculateSquares($numbersString)
{
    $numbersArray = explode(" ", $numbersString);
    $results = [];

    foreach ($numbersArray as $number) {
        $square = $number * $number;
        $results[] = [
            'number' => $number,
            'square' => $square
        ];
    }

    return $results;
}
