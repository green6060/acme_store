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
                <h1 class="pageTitle">Add a Category</h1>
                <h2>
                    <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                </h2>


                <form class="container" action="../products/index.php" method="post">
                    <label><b>Add a New Category of Products Below.</b></label>

                    <input type="text" placeholder="Choose a Category" name="ctgyName" <?php if(isset($catgName)){echo "value='$catgName'";} ?> required>

                    <button type="submit">Add Category</button>
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="newCategory">
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
