<?php
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the auto load file
require_once ("vendor/autoload.php");
require_once ("model/data-layer.php");
require_once ("model/validation.php");

//start a session
session_start();


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

        if (!validFirstN($_POST['fname'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["fname"]', "Invalid First Name.");
        }
        if (!validLastN($_POST['lname'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["lname"]', "Invalid Last Name.");
        }
        if (!validAge($_POST['age'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["age"]', "Invalid age.");
        }
        if (!validPhone($_POST['phone'])) {

            //Set an error variable in the F3 hive
            $f3->set('errors["phone"]', "Invalid phone.");
        }


        //valid
        if (empty($f3->get('errors'))) {
            //store the data in the session array

            if (!isset($_POST['premium'])){
                $member = new Member($_POST['fname'], $_POST['lname'], $_POST['age'],$_POST['gender'],$_POST['phone']);

                //track member type
                $_SESSION['prem'] = 'reg';

                //add member to session
                $_SESSION['myMember'] = $member;
                $f3->set('myMember', $member);

            }

            else {
                $premium = new PremiumMember($_POST['fname'], $_POST['lname'], $_POST['age'],$_POST['gender'],$_POST['phone']);

                $_SESSION['prem'] = 'prem';

                $_SESSION['myMember'] = $premium;
                $f3->set('myMember', $premium);
           }

            $f3->reroute('profile');
            session_destroy();
        }

    }

    $f3->set('fname', $_POST['fname']);
    $f3->set('lname', $_POST['lname']);
    $f3->set('phone', $_POST['phone']);
    $f3->set('gender', $_POST['gender']);
    $f3->set('age', $_POST['age']);
    $f3->set('premium', $_POST['premium']);
    //var_dump($_POST);

    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

//profile
$f3->route('GET|POST /profile', function($f3)
{
    $state = getStates();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        if (!validEmail($_POST['email'])) {
            //Set an error variable in the F3 hive
            $f3->set('errors["email"]', "Invalid email.");
        }

        if (!validState($_POST['selectStates'])) {
            //Set an error variable in the F3 hive
            $f3->set('errors["selectStates"]', "Invalid State.");
        }

        if (empty($f3->get('errors'))) {
            //store the data in the session array
            $_SESSION['myMember']->setEmail($_POST['email']);
            $_SESSION['myMember']->setSeeking($_POST['seeking']);
            $_SESSION['myMember']->setBio($_POST['bio']);
            $_SESSION['myMember']->setState($_POST['selectStates']);


            if ($_SESSION['prem']==='prem')
            {
                $f3->reroute('interests');
                session_destroy();
            }

            else{
                $f3->reroute('summary');
                session_destroy();
            }

        }
    }

    $f3->set('myStates', $state);
    $f3->set('email', $_POST['email']);
    $f3->set('state',  $_POST['selectStates']);
    $f3->set('seeking', $_POST['seeking']);
    $f3->set('bio', $_POST['bio']);

    $view = new Template();
    echo $view->render('views/profile.html');
});

//interests
$f3->route('GET|POST /interests', function($f3)
{
    $indoor = getIndoor();
    $outdoor = getOutdoor();


    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SESSION['myMember']->setInDoorInterests($_POST['indoor']);
        $_SESSION['myMember']->setOutDoorInterests($_POST['outdoor']);

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

