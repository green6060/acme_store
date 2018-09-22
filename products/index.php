<?php

/* 
 *  The controller of the Products related pages
 */

// REQUIRES file to: Grab DB connection file, used to connect to our Database
require_once ('../library/connections.php');
//REQUIRES file to: GRAB the 'Category' data from the database, to pass to the controller, through acme-model.php
require_once ('../model/acme-model.php');
// REQUIRES file to: SEND products information to DB, through products-model.php
require_once '../model/products-model.php';
// REQUIRES file to: GRAB Thumnail information from DB, through uploads-model.php
require_once '../model/uploads-model.php';
// REQUIRES file to: Run functions we've created for the purpose of server-side validation
require_once '../library/functions.php';

// Create or access a Session
session_start();

// Grabs the result of getCatagories() and assigns it to the $categories variable
$categories = getCategories();

// Puts a Nav bar together using the $categories array
$navList = buildNav($categories);

// Puts a list of categories together, using $categories array
$catgList = buildCatg($categories);

// Captures the "action" name/value pair, to help decide where the user needs to be directed
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

/****************************Switch Statements**********************************/

switch ($action){

/**************If the "Add a Category" button of the "Product Management" Page is selected, redirect the user to the "Add a Category Page*************************/
case 'category':
    include '../view/new-cat.php';
break;

/**************If the "Add a Product" button of the "Product Management" Page is selected, redirect the user to the "Add a Category Page*************************/

case 'product':
    include '../view/new-prod.php';
break;

/**************If the "Add Category" button of the "Add a Category" Page is selected,and all fields are filled out, sets $catgName variable  equal to contents of the form field, runs the newCategory function with $catgName as the arguement, attempts to insert the data into the Acme database *************************/
case 'newCategory':
    $catgName = filter_input(INPUT_POST, 'ctgyName', FILTER_SANITIZE_STRING);


    if (empty($catgName)) {
        $message = "Sorry,the field is empty! Please try again.";
        include '../view/new-cat.php';
        exit;
    }

    $rowsChanged = newCategory($catgName);
    
    if($rowsChanged === 1){
        header('Location: /cit336/acme/products/');
        exit;
        
    } else {
        $message = "Sorry,the category was not entered into the database for some reason. Please try again!";
        include '../view/new-cat.php';
        exit;
        
    }
break;

/**************If the "Add Product" button of the "Add a Product" Page is selected,and all fields are filled out, sets various variables equal to the contents of the form field, and runs the newProduct function with the various variables as the arguements, and attempts to insert the data into the Acme database *************************/

case 'newProduct':
    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_FLOAT);
    $invVend = filter_input(INPUT_POST, 'invVend', FILTER_SANITIZE_STRING);
    $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

    if (empty($invName) || empty($invDescription) ||empty($invImage) ||empty($invThumbnail) ||empty($invPrice) ||empty($invStock) ||empty($invSize) ||empty($invWeight) ||empty($invLocation) ||empty($categoryId) ||empty($invVend) ||empty($invStyle)) {
        $message = "Sorry, at least one of the fields is empty! Please try again.";
        include '../view/new-prod.php';
        exit;
    }

    $rowsChanged = newProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVend, $invStyle);
    
        if($rowsChanged === 1){
            $message = "The product was successfully added!";
            include '../view/new-prod.php';
            exit;
        } else {
            $message = "Something went wrong! Please try again!";
            include '../view/new-prod.php';
            exit;
        }
break;

/******************************************************************************/

case 'mod':
    
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $prodInfo = getProductInfo($invId);
    if(count($prodInfo)<1){
        $message = 'Sorry, no product information could be found.';
    }
    include '../view/prod-update.php';
    exit;
    break;

/******************************************************************************/
    
    case 'del':
        
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
        $prodInfo = getProductInfo($invId);
        
//        var_dump($prodInfo);
//        exit;
    
        if(count($prodInfo)<1){
        
            $message = 'Sorry, no product information could be found.';
    
        }
    
        include '../view/prod-delete.php';
    
        exit;
 
        break;

/******************************************************************************/
    
    case 'updateProd':
  
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
    
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
    
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_FLOAT);
    
        $invVend = filter_input(INPUT_POST, 'invVend', FILTER_SANITIZE_STRING);
    
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        
    if (empty($invName) || empty($invDescription) ||empty($invImage) ||empty($invThumbnail) ||empty($invPrice) ||empty($invStock) ||empty($invSize) ||empty($invWeight) ||empty($invLocation) ||empty($categoryId) ||empty($invVend) ||empty($invStyle)) {
        $message = "Sorry, at least one of the fields is empty! Please try again.";
        include '../view/prod-update.php';
        exit;
    }

    $updateResult = updateProduct($invId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVend, $invStyle);
    
        if ($updateResult) {        
            $message = "Congratulations, $invName was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /cit336/acme/products/');
            exit;
} else {
            $message = "Something went wrong! Please try again!";
            header('location: /cit336/acme/products/');
            exit;
        }
        
 break;

/******************************************************************************/
 
 case 'deleteProd':
  
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);

        var_dump($invId);
        var_dump($invName);
        exit;

    $deleteResult = deleteProduct($invId, $invName);

    
        if ($deleteResult) {        
            $message = "Congratulations, $invName was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /cit336/acme/products/');
            exit;
} else {
            $message = "Something went wrong! Please try again!";
            header('location: /cit336/acme/products/');
            exit;
        }
        
 break;

/******************************************************************************/

 case 'categoryView':
 $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);

 $products = getProductsByCategory($type);
 if(!count($products)){
  $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
 } else {
  $prodDisplay = buildProductsDisplay($products);
 }

 include '../view/category.php';
break;
 
/******************************************************************************/

case 'detailedProdView':

    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);

    $productsDetail = getProductsDetailsByCategory($invId);
    
    if(!count($productsDetail)){
  $message = "<p class='notice'>Sorry, no $productsDetail product details could be found.</p>";
 } else {
  $prodDetailDisplay = buildProductsDetailDisplay($productsDetail);
 }
    $productsDetailTn = getImagesTn($invId);
    
    if(!count($productsDetailTn)){
  $message = "<p class='notice'>Sorry, no $productsDetail product details could be found.</p>";
 } else {
  $prodDetailDisplayTn = buildProductsDetailDisplayTn($productsDetailTn);
//  var_dump($prodDetailDisplayTn);
//  exit;
 }
 include '../view/categoryDetail.php';
break;
 
/******************************************************************************/

default:

    $products = getProductBasics();
    if(count($products) > 0){
  
        $prodList = '<table>';
  
        $prodList .= '<thead>';
  
        $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
  
        $prodList .= '</thead>';
  
        $prodList .= '<tbody>';
  
        foreach ($products as $product) {
   
            $prodList .= "<tr><td>$product[invName]</td>";
   
            $prodList .= "<td><a href='/cit336/acme/products/?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
   
            $prodList .= "<td><a href='/cit336/acme/products/?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
  }
   
  $prodList .= '</tbody></table>';
  } else {
   
      $message = '<p class="notify">Sorry, no products were returned.</p>';
}

    include '../view/prod-mgmt.php';
    
}
?>