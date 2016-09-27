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

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM courses;");
    }
}
?>
