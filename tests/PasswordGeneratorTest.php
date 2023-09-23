<?php

use PHPUnit\Framework\TestCase;

include_once('class/PasswordGenerator.php');

class PasswordGeneratorTest extends TestCase
{
    public function testPasswordVariations()
    {
        $generator = new PasswordGenerator();

        // Test various combinations of characters and lengths
        $password1 = $generator->generatePassword(12, 4, 6, 2, 0);
        $this->assertEquals(12, strlen($password1));

        $password2 = $generator->generatePassword(8, 2, 4, 2, 0);
        $this->assertEquals(8, strlen($password2));

        $password3 = $generator->generatePassword(10, 0, 0, 0, 10);
        $this->assertEquals(10, strlen($password3));
    }

    public function testCharacterTypesAndLengths()
    {
        $generator = new PasswordGenerator();
        $password = $generator->generatePassword(12, 4, 4, 2, 2);

        // Assert that the password has the correct length
        $this->assertEquals(12, strlen($password));

        // Assert that the password contains the expected number of each character type
        $this->assertEquals(4, preg_match_all('/[a-z]/', $password));
        $this->assertEquals(4, preg_match_all('/[A-Z]/', $password));
        $this->assertEquals(2, preg_match_all('/[0-9]/', $password));
        $this->assertEquals(2, preg_match_all("/[!@#$%^&*()_+\-=[\]{}|;:,.<>?]/", $password));
    }

    public function testCharacterSets()
    {
        // Assert that the password consists of characters from the specified character sets
        $generator = new PasswordGenerator();
        $password = $generator->generatePassword(12, 4, 4, 2, 2);
        $validChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
        $this->assertMatchesRegularExpression('/^[' . preg_quote($validChars, '/') . ']+$/', $password);
    }
}
