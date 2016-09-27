<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";
    require_once "src/Student.php";

    $server = 'mysql:host=localhost;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Course::deleteAll();
          Student::deleteAll();
        }

        function testGetName()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = 1;
            $test_student = new Student($name, $enroll_date, $id);

            // Act
            $result = $test_student->getName();

            // Assert
            $this->assertEquals("Becky", $result);
        }
    }



?>
