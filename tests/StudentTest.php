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

        function testSave()
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

        function testGetAll()
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

        function testDeleteAll()
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

        function testNameUpdate()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = null;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            $new_name = "Rebecca";
            $new_enroll_date = "2017-02-13";

            // Act
            $test_student->update($new_name, $new_enroll_date);

            // Assert
            $this->assertEquals("Rebecca", $test_student->getName());
        }

        function testDateUpdate()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = null;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            $new_name = "Rebecca";
            $new_enroll_date = "2017-02-13";

            // Act
            $test_student->update($new_name, $new_enroll_date);

            // Assert
            $this->assertEquals("2017-02-13", $test_student->getEnrollDate());
        }

        function testFind()
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
            $result = Student::find($test_student->getId());

            // Assert
            $this->assertEquals($test_student, $result);
        }

        function testAddCourse()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = null;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            $name = "Biology";
            $course_number = "BS101";
            $id = null;
            $test_course = new Course($name, $course_number, $id);
            $test_course->save();

            // Act
            $test_student->addCourse($test_course);

            // Assert
            $this->assertEquals($test_student->getCourses(), [$test_course]);
        }

        function testGetCourses()
        {
            // Assemble
            $name = "Becky";
            $enroll_date = "2016-12-03";
            $id = null;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

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
            $test_student->addCourse($test_course);
            $test_student->addCourse($test_course2);

            // Assert
            $this->assertEquals($test_student->getCourses(), [$test_course, $test_course2]);
        }

        function testDelete()
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
            $test_student->delete();
            $result = Student::getAll();

            // Assert
            $this->assertEquals([$test_student2], $result);
        }
    }
?>
