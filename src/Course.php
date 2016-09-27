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

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM courses;");
    }
}
?>
