<?php

/*
 * The main controller of our ACME home Page
 */

// REQUIRES file to: Grab DB connection file, used to connect to our Database
require_once ('/library/connections.php');
//REQUIRES file to: GRAB the 'Category' data from the database, to pass to the controller, through acme-model.php
require_once ('/model/acme-model.php');
// REQUIRES file to: SEND registration/login information to DB, through accounts-model.php
require_once '/model/accounts-model.php';
// REQUIRES file to: Run functions we've created for the purpose of server-side validation
require_once '/library/functions.php';

// Create or access a Session
session_start();

// Grabs the result of getCatagories() and assigns it to the $categories variable
$categories = getCategories();

//Code we use for testing!
//var_dump($categories);
//exit;

// Puts a Nav bar together using the $catagories array
$navList = buildNav($categories);

//Code we use for testing!
//echo $navList;
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}


switch ($action){

/******************************************************************************/
 case 'registerAcnt':
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
        $message = "Sorry, one of the fields is empty! Please try again.";
        include '../view/register.php';
        exit;
    }

     //If everything validates correctly, we are finally able to call the regClient() function from the accounts-model, to insert the data into our database.

    regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

 break;

/******************************************************************************/

case 'loginAcnt':
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $checkEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    if(empty($clientEmail) || empty($clientPassword)) {
        $message = "Sorry, one of the fields is empty! Please try again.";
        include '../view/login.php';
        exit;
    }

    //If everything validates correctly, we are finally able to call the logClient() function from the accounts-model.
 break;

 /******************************************************************************/

 default:
    include 'view/home.php';
}
