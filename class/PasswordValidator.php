<?php
class PasswordValidator
{
    private $passwordLength;
    private $lowercaseLength;
    private $uppercaseLength;
    private $numberLength;
    private $specialCharsLength;
    private $allowedSpecialChars = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    public function __construct($passwordLength, $lowercaseLength, $uppercaseLength, $numberLength, $specialCharsLength)
    {
        $this->passwordLength = $passwordLength;
        $this->lowercaseLength = $lowercaseLength;
        $this->uppercaseLength = $uppercaseLength;
        $this->numberLength = $numberLength;
        $this->specialCharsLength = $specialCharsLength;
    }

    public function validate($password)
    {
        if (
            strlen($password) > $this->passwordLength // chech length of password
            || preg_match_all('/[a-z]/', $password) < $this->lowercaseLength // check length of lowercase characters
            || preg_match_all('/[A-Z]/', $password) < $this->uppercaseLength // check length of uppercase characters
            || preg_match_all('/[0-9]/', $password) < $this->numberLength // check length of numbers
            || preg_match_all('/[' . preg_quote($this->allowedSpecialChars, '/') . ']/', $password) < $this->specialCharsLength // check if special characters is allowed, and the length
        ) {
            return false;
        }

        return true;
    }
}
