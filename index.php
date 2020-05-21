<?php
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//start a session
session_start();

//require the auto load file
require_once ("vendor/autoload.php");
require_once ("model/data-layer.php");
require_once ("model/validation.php");

//instantiate the F3 Base class
$f3 = Base::instance();

//default route
$f3->route('GET /', function()
{
    $view = new Template();
    echo $view->render('views/home.html');
});

//personal Information route
$f3->route('GET|POST /personal', function($f3)
{
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //var_dump($_POST);

        if (!validName($_POST['fname'], $_POST['lname'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["fname"]', "Invalid First Name.");
            $f3->set('errors["lname"]', "Invalid Last Name.");
        }
        if (!validAge($_POST['age'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["age"]', "Invalid age.");
        }
        if (!validEmail($_POST['email'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["email"]', "Invalid email.");
        }
        if (!validPhone($_POST['phone'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["phone"]', "Invalid phone.");
        }


        //valid
        if (empty($f3->get('errors'))) {
            //store the data in the session array
            $_SESSION['fname'] = $_POST['fname'];
            $_SESSION['lname'] = $_POST['lname'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['age'] = $_POST['age'];


            $f3->reroute('profile');
            session_destroy();
        }

    }

    $f3->set('fname', $_POST['fname']);
    $f3->set('lname', $_POST['lname']);
    $f3->set('phone', $_POST['phone']);
    $f3->set('gender', $_POST['gender']);
    $f3->set('age', $_POST['age']);

    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

//profile
$f3->route('GET|POST /profile', function($f3)
{
    $state = getStates();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //store the data in the session array
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];
        $_SESSION['selectStates'] = $_POST['selectStates'];

        $f3->reroute('interests');
        session_destroy();
    }

    $f3->set('myStates', $state);

    $view = new Template();
    echo $view->render('views/profile.html');
});

//interests
$f3->route('GET|POST /interests', function($f3)
{
    $indoor = getIndoor();
    $outdoor = getOutdoor();


    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //store the data in the session array
        $_SESSION['indoor'] = $_POST['indoor'];
        $_SESSION['outdoor'] = $_POST['outdoor'];


        $f3->reroute('summary');
        session_destroy();
    }
    $f3->set('interests', $indoor);
    $f3->set('interests2', $outdoor);

    $view = new Template();
    echo $view->render('views/interests.html');
});

//summary
$f3->route('GET /summary', function()
{
    //var_dump($_SESSION);
    $view = new Template();
    echo $view->render('views/summary.html');
});

//run f3
$f3->run();

