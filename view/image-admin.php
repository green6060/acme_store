<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="utf-8">
        <meta name="description" content="Short page description.">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title>Image Uploading</title>
         <link rel="stylesheet" type="text/css" href="/cit336/acme/support/css/styles.css" media="screen">
    </head>

    <body>
        <div id="wrapper">

            <header id="header">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/cit336/acme/modules/header.php'; ?>
            </header>
            
            <main id="main">
                
                <?php 
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                }
                ?>
                
                <h1>Image Uploading Form</h1>
                
                <h2>Add New Product Image</h2>
                
                <form action="/cit336/acme/uploads/" method="post" enctype="multipart/form-data">
                    <label for="invItem">Product</label><br>
                    <?php echo $prodSelect; ?><br><br>
                    <label>Upload Image:</label><br>
                    <input type="file" name="file1"><br>
                    <input type="submit" class="regbtn" value="Upload">
                    <input type="hidden" name="action" value="upload">
                </form>
                <hr>
                
                <h2>Existing Images</h2>
                <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
                <?php
                if (isset($imageDisplay)) {
                 echo $imageDisplay;
                }
?>
                
            </main>

            <footer id="footer">
                <br> &copy;2017 ACME Inc. All rights reserved. <br> All images are believed to be in "Fair Use". Please notify the author if any are not and they will be removed.
            </footer>

        </div>

    </body>

</html>
<?php unset($_SESSION['message']); ?>