<?php
class Course
{
    private $id;
    private $course_name;
    private $course_number;

    function __construct($course_name, $course_number, $id = null)
    {
        $this->course_name = $course_name;
        $this->course_number = $course_number;
        $this->id = $id;
    }

    function setName($new_course_name)
    {
        $this->course_name = $new_course_name;
    }

    function getName()
    {
        return $this->course_name;
    }

    function setCourseNumber($new_course_number)
    {
        $this->course_number = $new_course_number;
    }

    function getCourseNumber()
    {
        return $this->course_number;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO courses (course_name, course_number) VALUES ('{$this->getName()}', '{$this->getCourseNumber()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $courses = array();
        $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
        foreach($returned_courses as $course) {
            $course_name = $course['course_name'];
            $course_number = $course['course_number'];
            $id = $course['id'];
            $new_course = new Course($course_name, $course_number, $id);
            array_push($courses, $new_course);
        }
        return $courses;
    }

    static function find($search_id)
    {
        $found_course = null;
        $courses = Course::getAll();
        foreach($courses as $course) {
            $course_id = $course->getId();
            if ($course_id == $search_id) {
                $found_course = $course;
            }
        }
        return $found_course;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM courses;");
    }

    function update($new_name, $new_number)
    {
        $GLOBALS['DB']->exec("UPDATE courses SET course_name = '{$new_name}', course_number = '{$new_number}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
        $this->setCourseNumber($new_number);
    }

    function addStudent($student)
    {
        $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$this->getId()}, {$student->getId()});");
    }

    function getStudents()
    {
        $students = array();
        $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses JOIN courses_students ON (courses_students.course_id = courses.id) JOIN students ON (students.id = courses_students.student_id) WHERE courses.id = {$this->getId()};");
        foreach($returned_students as $student) {
            $student_name = $student['student_name'];
            $enroll_date = $student['enroll_date'];
            $id = $student['id'];
            $new_student = new Student($student_name, $enroll_date, $id);
            array_push($students, $new_student);
        }
        return $students;
    }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE id = {$this->getId()};");
    }
}
?>
