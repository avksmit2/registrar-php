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

        function testSetName()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = 1;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->setName("Rebecca");

            // Act
            $result = $test_student->getName();

            // Assert
            $this->assertEquals("Rebecca", $result);
        }

        function testSetEnrollDate()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = 1;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->setEnrollDate("2017-02-13");

            // Act
            $result = $test_student->getEnrollDate();

            // Assert
            $this->assertEquals("2017-02-13", $result);
        }

        function testGetId()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = 1;
            $test_student = new Student($name, $enroll_date, $id);

            // Act
            $result = $test_student->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function save()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = 1;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            // Act
            $result = Student::getAll();

            // Assert
            $this->assertEquals($test_student, $result[0]);
        }

        function getAll()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = null;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            $name2 = "Francis";
            $enroll_date2 = "2016-09-27";
            $id2 = null;
            $test_student2 = new Student($name2, $enroll_date2, $id2);
            $test_student2->save();

            // Act
            $result = Student::getAll();

            // Assert
            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function deleteAll()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = null;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            $name2 = "Francis";
            $enroll_date2 = "2016-09-27";
            $id2 = null;
            $test_student2 = new Student($name2, $enroll_date2, $id2);
            $test_student2->save();

            // Act
            Student::deleteAll();
            $result = Student::getAll();

            // Assert
            $this->assertEquals([], $result);
        }
    }



?>
