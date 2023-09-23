<?php
// includes
include_once('class/PasswordGenerator.php');
include_once('class/PasswordValidator.php');

// variables
$lengthOfPassword = 12;
$amountOfLowerCase = $amountOfUpperCase = 4;
$amountOfNumbers = $amountOfSpecialChars = 2;
$response = "Invalid password, you need to reconfigure it";

// call classes
$generator = new PasswordGenerator();
$validator = new PasswordValidator($lengthOfPassword, $amountOfLowerCase, $amountOfUpperCase, $amountOfNumbers, $amountOfSpecialChars);

// generate password and validate it
$password = $generator->generatePassword($lengthOfPassword, $amountOfLowerCase, $amountOfUpperCase, $amountOfNumbers, $amountOfSpecialChars);
if ($validator->validate($password)) {
    $response = "Here's the generated and valid password! <br/> $password";
}

// echo out response 
echo $response;
