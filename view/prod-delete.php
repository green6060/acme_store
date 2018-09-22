<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] < 2){
    header('Location: /cit336/acme/');
    exit;
};
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

    <!DOCTYPE html>
    <html lang="en-us">

    <head>
        <meta charset="utf-8">
        <meta name="description" content="Short page description.">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title>
            <?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?> | Acme, Inc.</title>
        <link rel="stylesheet" href="../support/css/styles.css" media="screen">
    </head>

    <body>
        <div id="wrapper">

            <header id="header">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/cit336/acme/modules/header.php'; ?>
            </header>
            <main id="main">

                <h1>
                    <?php
                if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";}
                ?>
                </h1>

                <h2>
                    <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                </h2>

                <form class="container" method="post" action="/cit336/acme/products/index.php">
                    <label><b>Confirm Product Deletion. The delete is permanent.</b></label>
                    <br>
                    <br>
                    <label><b>Choose a Category</b></label>
                    <?php

                    // Build the categories option list
                    $catList = '<select name="categoryId" id="categoryId">';
                    $catList .= "<option>Choose a Category</option>";
                    foreach ($categories as $category) {
                     $catList .= "<option value='$category[categoryId]'";
                      if(isset($categoryId)){
                       if($category['categoryId'] === $categoryId){
                       $catList .= ' selected ';
                      }
                     } elseif(isset($prodInfo['categoryId'])){
                      if($category['categoryId'] === $prodInfo['categoryId']){
                       $catList .= ' selected ';
                      }
                    }
                    $catList .= ">$category[categoryName]</option>";
                    }
                    $catList .= '</select>';

                    echo $catList;
                    ?>

                    <br>
                    <br>
                    <label><b>Product Name</b></label>
                    <input type="text" readonly name="invName" id="invName" <?php if(isset($prodInfo[ 'invName'])) {echo "value='$prodInfo[invName]'"; }?>>

                    <label><b>Product Description </b></label>
                    <textarea name="invDescription" readonly id="invDescription"><?php if(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea>

                    <button type="submit" name="submit" value="Delete Product">Delete Product</button>
                    <!-- Delete the action name - value pair -->
                    <input type="hidden" name="action" value="deleteProd">

                    <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">

                </form>
            </main>

            <footer id="footer">
                <br> &copy;2017 ACME Inc. All rights reserved. <br> All images are believed to be in "Fair Use". Please notify the author if any are not and they will be removed.
            </footer>

        </div>
        <!-- JQUERY CDN
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

        <script src="js/acme.js"></script>
        -->
    </body>

    </html>
