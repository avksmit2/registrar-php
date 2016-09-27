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

        function testSetName()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = 1;
            $test_course = new Course($name, $course_number, $id);
            $test_course->setName("Biology 101");

            // Act
            $result = $test_course->getName();

            // Assert
            $this->assertEquals("Biology 101", $result);
        }

        function testSetCourseNumber()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = 1;
            $test_course = new Course($name, $course_number, $id);
            $test_course->setCourseNumber("BS101N");

            // Act
            $result = $test_course->getCourseNumber();

            // Assert
            $this->assertEquals("BS101N", $result);
        }

        function testGetId()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = 1;
            $test_course = new Course($name, $course_number, $id);

            // Act
            $result = $test_course->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function testSave()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = null;
            $test_course = new Course($name, $course_number, $id);
            $test_course->save();

            // Act
            $result = Course::getAll();

            // Assert
            $this->assertEquals($test_course, $result[0]);
        }

        function getAll()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = null;
            $test_course = new Course($name, $course_number, $id);
            $test_course->save();

            $name2 = "English";
            $course_number2 = "LE101";
            $id2 = null;
            $test_course2 = new Course($name2, $course_number2, $id2);
            $test_course2->save();

            // Act
            $result = Course::getAll();

            // Assert
            $this->assertEquals([$test_course, $test_course2], $result[0]);
        }

        function testDeleteAll()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = null;
            $test_course = new Course($name, $course_number, $id);
            $test_course->save();

            $name2 = "English";
            $course_number2 = "LE101";
            $id2 = null;
            $test_course2 = new Course($name2, $course_number2, $id2);
            $test_course2->save();

            // Act
            Course::deleteAll();
            $result = Course::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = null;
            $test_course = new Course($name, $course_number, $id);
            $test_course->save();

            $name2 = "English";
            $course_number2 = "LE101";
            $id2 = null;
            $test_course2 = new Course($name2, $course_number2, $id2);
            $test_course2->save();

            // Act
            $result = Course::find($test_course->getId());

            // Assert
            $this->assertEquals($test_course, $result);
        }

        function testAddStudent()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = null;
            $test_course = new Course($name, $course_number, $id);
            $test_course->save();

            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = null;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            // Act
            $test_course->addStudent($test_student);

            // Assert
            $this->assertEquals($test_course->getStudents(), [$test_student]);
        }

        function testGetStudents()
        {
            // Assemble
            $name = "Biology";
            $course_number = "BS101";
            $id = null;
            $test_course = new Course($name, $course_number, $id);
            $test_course->save();

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
            $test_course->addStudent($test_student);
            $test_course->addStudent($test_student2);

            // Assert
            $this->assertEquals($test_course->getStudents(), [$test_student, $test_student2]);
        }
    }



?>
