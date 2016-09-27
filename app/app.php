<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Course.php";
    require_once __DIR__."/../src/Student.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=registrar';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render("index.html.twig");
    });

    $app->get("/courses", function() use ($app) {
        return $app['twig']->render("courses.html.twig", array('courses' => Course::getAll()));
    });

    $app->post("/courses_add", function() use ($app) {
        $course_name = $_POST['course_name'];
        $course_number = $_POST['course_number'];
        $course = new Course($course_name, $course_number);
        $course->save();

        return $app['twig']->render("courses.html.twig", array('courses' => Course::getAll()));
    });

    $app->get("/courses_delete", function() use ($app) {
        Course::deleteAll();

        return $app['twig']->render("courses.html.twig", array('courses' => Course::getAll()));
    });

    $app->get("/course/{id}", function($id) use ($app) {
        $course = Course::find($id);

        return $app['twig']->render("course_students.html.twig", array('course' => $course, 'students' => $course->getStudents(), 'all_students' => Student::getAll()));
    });

    $app->get("/course_students/{id}", function($id) use ($app) {
        $course = Course::find($id);

        return $app['twig']->render("course_students.html.twig", array('course' => $course, 'students' => $course->getStudents(), 'all_students' => Student::getAll()));
    });

    $app->post("/add_students", function() use ($app) {
        $course = Course::find($_POST['course_id']);
        $student = Student::find($_POST['student_id']);
        $course->addStudent($student);

        return $app['twig']->render("course_students.html.twig", array('course' => $course, 'students' => $course->getStudents(), 'all_students' => Student::getAll()));
    });

    $app->patch("/update_course/{id}", function($id) use ($app) {
        $course = Course::find($id);
        $new_course_name = $_POST['new_course_name'];
        $new_course_number = $_POST['new_course_number'];
        $course->update($new_course_name, $new_course_number);
        $course->save();

        return $app['twig']->render("course_students.html.twig", array('course' => $course, 'students' => $course->getStudents(), 'all_students' => Student::getAll()));
    });

    $app->delete("/delete_course/{id}", function($id) use ($app) {
        $course = Course::find($id);
        $course->delete();

        return $app['twig']->render("index.html.twig");
    });

    $app->get("/students", function() use ($app) {
        return $app['twig']->render("students.html.twig", array('students' => Student::getAll()));
    });

    $app->post("/students_add", function() use ($app) {
        $student_name = $_POST['student_name'];
        $enroll_date = $_POST['enroll_date'];
        $student = new Student($student_name, $enroll_date);
        $student->save();

        return $app['twig']->render("students.html.twig", array('students' => Student::getAll()));
    });

    $app->get("/students_delete", function() use ($app) {
        Student::deleteAll();

        return $app['twig']->render("students.html.twig", array('students' => Student::getAll()));
    });

    $app->get("/student_courses/{id}", function($id) use ($app) {
        $student = Student::find($id);

        return $app['twig']->render("student_courses.html.twig", array('student' => $student, 'courses' => $student->getCourses(), 'all_courses' => Course::getAll()));
    });

    $app->post("/add_courses", function() use ($app) {
        $course = Course::find($_POST['course_id']);
        $student = Student::find($_POST['student_id']);
        $student->addCourse($course);

        return $app['twig']->render("student_courses.html.twig", array('student' => $student, 'courses' => $student->getCourses(), 'all_courses' => Course::getAll()));
    });

    $app->patch("/update_student/{id}", function($id) use ($app) {
        $student = Student::find($id);
        $new_student_name = $_POST['new_student_name'];
        $new_student_number = $_POST['new_enroll_date'];
        $student->update($new_student_name, $new_enroll_date);
        $student->save();

        return $app['twig']->render("student_courses.html.twig", array('student' => $student, 'courses' => $student->getCourses(), 'all_courses' => Course::getAll()));
    });

    $app->delete("/delete_student/{id}", function($id) use ($app) {
        $student = Student::find($id);
        $student->delete();

        return $app['twig']->render("index.html.twig");
    });

    return $app;
?>
