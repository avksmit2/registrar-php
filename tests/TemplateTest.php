<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/***.php";
    require_once "src/***.php";

    $server = 'mysql:host=localhost;dbname=***_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class *** extends PHPUnit_Framework_TestCase
    {
        function test_***()
        {
            // Assemble
            $test_Variable = new Template("Argument Here");
            $input = "Input Test Text Here";

            // Act
            $result = $test_Variable->methodName($input);

            // Assert
            $this->assertEquals(true, $result);
        }
    }



?>
