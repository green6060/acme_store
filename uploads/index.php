<?php

/*
 * The controller of our uploading process
 */

// REQUIRES file to: Grab DB connection file, used to connect to our Database
require_once ('../library/connections.php');
//REQUIRES file to: GRAB the 'Category' data from the DB, to pass to the controller, through acme-model.php
require_once ('../model/acme-model.php');
// REQUIRES file to: SEND product information to DB, through products-model.php
require_once '../model/products-model.php';
// REQUIRES file to: SEND upload information to DB, through uploads-model.php
require_once '../model/uploads-model.php';
// REQUIRES file to: Run functions we've created for the purpose of server-side validation
require_once '../library/functions.php';

// Create or access a Session
session_start();

//Grabs the result of getCatagories() and assigns it to the $categories variable
$categories = getCategories();
// Puts a Nav bar together using the $catagories array
$navList = buildNav($categories);

/* * ****************************************************
* Variables for use with the Image Upload Functionality
* **************************************************** */
// directory name where uploaded images are stored
$image_dir = '/cit336/acme/images/products/';
// The path is the full path from the server root
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    
    case 'upload':
        // Store the incoming product id
        $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
        // Store the name of the uploaded image
        $imgName = $_FILES['file1']['name'];
        $imageCheck = checkExistingImage($imgName);
        
        if($imageCheck){
            $message = '<p class="notice">An image by that name already exists.</p>';
        } elseif (empty($invId) || empty($imgName)) {
            $message = '<p class="notice">You must select a product and image file for the product.</p>';
        } else {
        // Upload the image, store the returned path to the file
        $imgPath = uploadFile('file1');
        // Insert the image information to the database, get the result
        $result = storeImages($invId, $imgPath, $imgName);
        // Set a message based on the insert result
        if ($result) {
            $message = '<p class="notice">The upload succeeded.</p>';
        } else {
            $message = '<p class="notice">Sorry, the upload failed.</p>';
        }
    }
        // Store message to session
        $_SESSION['message'] = $message;
        // Redirect to this controller for default action
        header('location: .');
        break;
    
    case 'delete':
        // Get the image name and id
        $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
        $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);
        
        // Build the full path to the image to be deleted
        $target = $image_dir_path . '/' . $filename;
        
        // Check that the file exists in that location
        if (file_exists($target)) {
         // Deletes the file in the folder
         $result = unlink($target); 
        }
        
        // Remove from database only if physical file deleted
        if ($result) {
         $remove = deleteImages($imgId);
        }

        // Set a message based on the delete result
        if ($remove) {
         $message = "<p class='notice'>$filename was successfully deleted.</p>";
        } else {
         $message = "<p class='notice'>$filename was NOT deleted.</p>";
        }

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        header('location: .');
        break;
   
    default:
        // Call function to return image info from database
        $imageArray = getImages();

        // Build the image information into HTML for display
        if (count($imageArray)) {
         $imageDisplay = buildImageDisplay($imageArray);
        } else {
         $imageDisplay = '<p class="notice">Sorry, no images could be found.</p>';
        }

        // Get inventory information from database
        $products = getProductBasics();
        // Build a select list of product information for the view
        $prodSelect = buildProductSelect($products);

        include '../view/image-admin.php';
        break;
}