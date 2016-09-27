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

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO students (student_name, enroll_date) VALUES ('{$this->getName()}', '{$this->getEnrollDate()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $students = array();
        $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
        foreach($returned_students as $student) {
            $student_name = $student['student_name'];
            $enroll_date = $student['enroll_date'];
            $id = $student['id'];
            $new_student = new Student($student_name, $enroll_date, $id);
            array_push($students, $new_student);
        }
        return $students;
    }

    static function find($search_id)
    {
        $found_student = null;
        $students = Student::getAll();
        foreach($students as $student) {
            $student_id = $student->getId();
            if ($student_id == $search_id) {
                $found_student = $student;
            }
        }
        return $found_student;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM students;");
    }
}
?>
