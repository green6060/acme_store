<?php

/* 
 *  The controller of the ACME Accounts related pages
 */

// REQUIRES file to: Grab DB connection file, used to connect to our Database
require_once ('../library/connections.php');
// REQUIRES file to: Run functions we've created for the purpose of server-side validation
require_once '../library/functions.php';
//REQUIRES file to: GRAB the 'Category' data from the database, to pass to the controller, through acme-model.php
require_once ('../model/acme-model.php');
// REQUIRES file to: SEND registration/login information to DB, through accounts-model.php
require_once '../model/accounts-model.php';

// Create or access a Session
session_start();

/******************************************************************************/

//Grabs the result of getCatagories() and assigns it to the $categories variable
$categories = getCategories();

/******************************************************************************/

//Code we use for testing!
//var_dump($categories);
//exit;

/******************************************************************************/

//Grabs the result of buildNav() and assigns it to the $categories variable
$navList = buildNav($categories);

/******************************************************************************/

//Code we use for testing!
//echo $navList;
//exit;

/******************************************************************************/

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}



/*******************************************************************************
*******************************************************************************/

switch ($action){
    
/******************************************************************************/
 case 'login':
     
    include '../view/login.php';
 
    break;

/******************************************************************************/

case 'register':
     
    include '../view/register.php';
 
    break;

/******************************************************************************/

case 'loginAcnt':
    
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);

    $clientEmail = checkEmail($clientEmail);

    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

    $passwordCheck = checkPassword($clientPassword);

// Run basic checks, return if errors
    if (empty($clientEmail) || empty($passwordCheck)) {
  
        $message = '<p>Please provide a valid email address and password.</p>';
  
        include '../view/login.php';
  
        exit;
}

// A valid password exists, proceed with the login process
// Query the client data based on the email address
$clientData = getClient($clientEmail);

//var_dump($clientData);
//exit;

// Compare the password just submitted against
// the hashed password for the matching client
$hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

// If the hashes don't match create an error
// and return to the login view
if (!$hashCheck) {
  $message = '<p>Please check your password and try again.</p>';
  include '../view/login.php';
  exit;
}

//if(isset($_COOKIE[$clientFirstname])){
//    setcookie('firstname', $clientFirstname, 1);
//}
//
//$clientFirstname = $clientData['clientFirstname'];
//
//setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');

// A valid user exists, log them in
$_SESSION['loggedin'] = TRUE;

// Remove the password from the array
// the array_pop function removes the last
// element from an array
array_pop($clientData);

// Store the array into the session
$_SESSION['clientData'] = $clientData;

// Send them to the admin view
include '../view/admin.php';
exit;

/******************************************************************************/

case 'registerAcnt':

    // Filters and Stores text from First Name field
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    
    // Filters and Stores text from Last Name field
    $clientLastname = filter_input(INPUT_POST, 'clientLastname',  FILTER_SANITIZE_STRING);
    // Filters and Stores text from Email field
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    
    // Filters and Stores text from Password field
    $clientPassword = filter_input(INPUT_POST, 'clientPassword',  FILTER_SANITIZE_STRING);

    $checkEmail = checkEmail($clientEmail);

    $checkPassword = checkPassword($clientPassword);
    
    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($checkEmail) || empty($checkPassword)) {
        $message = "<p>Sorry, one of the fields is invalid! Please try again.</p>";
        include '../view/register.php';
        exit;
    }
    
    // Check for existing email address in the table
    $existingEmail = checkExistingEmail($clientEmail);
    if($existingEmail){
      $message = '<p>That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
}
    
    $passwordHash = (password_hash($clientPassword, PASSWORD_DEFAULT));
    
    $rowsChanged = regClient($clientFirstname, $clientLastname, $clientEmail, $passwordHash);
    
    if($rowsChanged === 1){
        $message = "<p>You have been succesfully registered!</p>";
        include '../view/login.php';
        exit;
    } else {
        $message = "<p>Something went wrong! Please try again!</p>";
        include '../view/register.php';
        exit;
    }
    
    break;
 
/******************************************************************************/
 case 'ClientUpdate':
    include '../view/client-update.php';
    break;
    
/******************************************************************************/

case 'UpdateClientInfo':
    
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    
    
    if (empty($clientFirstname) || empty($clientLastname) ||empty($clientEmail)) {
        $message = "Sorry, at least one of the fields is empty! Please try again.";
        include '../view/client-update.php';
        exit;
    }

    $clientUpdate = clientUpdate($clientId, $clientFirstname, $clientLastname, $clientEmail);
    
        if ($clientUpdate) {
            $message = "Congratulations, your information was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /cit336/acme/view/admin.php');
            exit;
} else {
            $message = "Something went wrong! Please try again!";
            header('location: /cit336/acme/view/admin.php');
            exit;
        }
        
    
    break;

/******************************************************************************/

case 'UpdateClientPassword':
    
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    

    if (empty($clientPassword)) {
        $message = "Sorry, at least one of the fields is empty! Please try again.";
        include '../view/client-update.php';
        exit;
    }

    $passwordHash = (password_hash($clientPassword, PASSWORD_DEFAULT));
    
    $clientPasswordUpdate = clientPasswordUpdate($clientId, $passwordHash);
    
        if ($clientUpdate) {
            $message = "Congratulations, your information was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /cit336/acme/view/admin.php');
            exit;
} else {
            $message = "Something went wrong! Please try again!";
            header('location: /cit336/acme/view/admin.php');
            exit;
        }
        
    
    break;    
    
/******************************************************************************/    

    case 'logout':   
        session_destroy();
        header('Location: /cit336/acme/');
    break;
    

/******************************************************************************/
 
    default:
    
    include '../view/admin.php';
}