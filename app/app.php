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

    // $app->get("/courses_students/{id}", function($id) use ($app) {
    //
    //     $students =
    //     return $app['twig']->render("courses_students.html.twig", array('courses' => Course::getAll()));
    // });

    $app->get("/courses_delete", function() use ($app) {
        Course::deleteAll();

        return $app['twig']->render("courses.html.twig", array('courses' => Course::getAll()));
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

    return $app;
?>
