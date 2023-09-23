<?php
class PasswordGenerator
{
    private $lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
    private $uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private $numberChars = '0123456789';
    private $specialChars = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    // multibyte str_shuffle function
    private function mb_str_shuffle($str)
    {
        $chars = preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
        shuffle($chars);
        return implode('', $chars);
    }

    public function generatePassword(int $lengthOfPassword, int $amountOfLowerCase, int $amountOfUpperCase, int $amountOfNumbers, int $amountOfSpecialChars): string
    {
        // variables
        $numTotal = $amountOfLowerCase + $amountOfUpperCase + $amountOfNumbers + $amountOfSpecialChars;
        $allChars = '';

        // check if amount of characters, does not exceed the requested length of password
        if ($numTotal > $lengthOfPassword) {
            return "Error: The sum of requested characters is greater than the maximum length of the password";
        }

        // Take random characters in each character set, append to string, and remove X amount of characters
        $allChars .= mb_substr($this->mb_str_shuffle($this->lowercaseChars), 0, $amountOfLowerCase);
        $allChars .= mb_substr($this->mb_str_shuffle($this->uppercaseChars), 0, $amountOfUpperCase);
        $allChars .= mb_substr($this->mb_str_shuffle($this->numberChars), 0, $amountOfNumbers);
        $allChars .= mb_substr($this->mb_str_shuffle($this->specialChars), 0, $amountOfSpecialChars);

        // return password, cut it down, so it equals $numTotal
        return $this->mb_str_shuffle(mb_substr($allChars, 0, $numTotal));
    }
}
