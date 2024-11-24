<?php
// Function to transform a string to all uppercase letters
function toUpperCase($string) {
    return strtoupper($string);
}

// Function to transform a string to all lowercase letters
function toLowerCase($string) {
    return strtolower($string);
}

// Function to make the first character of a string uppercase
function capitalizeFirstCharacter($string) {
    return ucfirst($string);
}

// Function to make the first character of each word uppercase
function capitalizeFirstCharacterOfEachWord($string) {
    return ucwords($string);
}

// Example usage
$inputString = "hello world! this is a test string.";

// Transformations
echo "Original String: " . $inputString . "\n";
echo "Uppercase: " . toUpperCase($inputString) . "\n";
echo "Lowercase: " . toLowerCase($inputString) . "\n";
echo "First Character Uppercase: " . capitalizeFirstCharacter($inputString) . "\n";
echo "First Character of Each Word Uppercase: " . capitalizeFirstCharacterOfEachWord($inputString) . "\n";
?>