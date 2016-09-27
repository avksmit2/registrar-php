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

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Course::deleteAll();
          Student::deleteAll();
        }

        function testGetName()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = 1;
            $test_course = new Template($name, $course_number, $id);

            // Act
            $result = $test_course->getName();

            // Assert
            $this->assertEquals("Biology", $result);
        }
    }



?>
