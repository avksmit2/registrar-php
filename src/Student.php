<?php
class Student
{
    private $id;
    private $student_name;
    private $enroll_date;

    function __construct($student_name, $enroll_date, $id=null)
    {
        $this->student_name = $student_name;
        $this->enroll_date = $enroll_date;
        $this->id = $id;
    }

    function setName($new_student_name)
    {
        $this->student_name = $new_student_name;
    }

    function getName()
    {
        return $this->student_name;
    }

    function setEnrollDate($new_enroll_date)
    {
        $this->enroll_date = $new_enroll_date;
    }

    function getEnrollDate()
    {
        return $this->enroll_date;
    }

    function getId()
    {
        return $this->id;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM students;");
    }
}
?>
