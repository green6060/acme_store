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
        <title id="title">Add a Product</title>
        <link rel="stylesheet" href="../support/css/styles.css" media="screen">
    </head>

    <body>
        <div id="wrapper">

            <header id="header">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/cit336/acme/modules/header.php'; ?>
            </header>
            <main id="main">
                <h1 class="pageTitle">Add a Product</h1>
                <h2>
                    <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                </h2>
                <form class="container" method="post" action="../products/index.php">
                    <label><b>Add a New Product Below. All Fields Required!</b></label>
                    <br>
                    <br>
                    <label><b>Choose a Category</b></label>
                    <?php echo $catgList ?>
                    <br>
                    <br>
                    <label><b>Product Name</b></label>
                    <input type="text" placeholder="Enter Name of Product" name="invName" <?php if(isset($invName)){echo "value='$invName'";} ?> required>

                    <label><b>Product Description </b></label>
                    <input type="text" placeholder="Enter Product Description" name="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";} ?> required>

                    <label><b>Product Image (Path to Image)</b></label>
                    <input type="text" placeholder="Enter Image URL for Product Image " name="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} ?> required>

                    <label><b>Product Thumbnail (Path to Thumbnail)</b></label>
                    <input type="text" placeholder="Enter Image URL for Product Thumbnail " name="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required>

                    <label><b>Product Price</b></label>
                    <input type="text" placeholder="Enter Product Price " name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required>

                    <label><b># in stock</b></label>
                    <input type="text" placeholder="Enter number of product in stock " name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required>

                    <label><b>Shipping Size (W x H x L in inches)</b></label>
                    <input type="text" placeholder="Enter Shipping Size " name="invSize" <?php if(isset($invSize)){echo "value='$invSize'";} ?> required>

                    <label><b>Weight (lbs.)</b></label>
                    <input type="text" placeholder="Enter Weight " name="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";} ?> required>

                    <label><b>Location (City Name)</b></label>
                    <input type="text" placeholder="Enter City Name " name="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";} ?> required>

                    <label><b>Vendor Name</b></label>
                    <input type="text" placeholder="Enter Vendor " name="invVend" <?php if(isset($invVend)){echo "value='$invVend'";} ?> required>

                    <label><b>Product Material</b></label>
                    <input type="text" placeholder="Enter Final Material " name="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";} ?> required>


                    <button type="submit">Add Product</button>
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="newProduct">
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
