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
        <title id="title">Client Info Update | ACME</title>
        <link rel="stylesheet" href="../support/css/styles.css" media="screen">
    </head>

    <body>
        <div id="wrapper">

            <header id="header">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/cit336/acme/modules/header.php'; ?>
            </header>

            <main id="main">

                <h1 class="pageTitle">
                    Update My Info
                </h1>

                <h2>
                    <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                </h2>


                <form class="container" method="post" action="/cit336/acme/accounts/index.php">
                    <label><b>Modify a Your Account Info Below. All Fields Required!</b></label>


                        <label><b>First name</b></label>
                        <input type="text" placeholder="Enter First Name" name="clientFirstname" <?php if(isset($_SESSION[ 'clientData'][ 'clientFirstname'])) {echo "value=" . $_SESSION[ "clientData"][ "clientFirstname"]; }?> required>

                        <label><b>Last name</b></label>
                        <input type="text" placeholder="Enter Last Name" name="clientLastname" <?php if(isset($_SESSION[ 'clientData'][ 'clientLastname'])) {echo "value=" . $_SESSION[ "clientData"][ "clientLastname"]; }?> required>

                        <label><b>Email</b></label>
                        <input type="text" placeholder="Enter Email" name="clientEmail" <?php if(isset($_SESSION[ 'clientData'][ 'clientEmail'])) {echo "value=" . $_SESSION[ "clientData"][ "clientEmail"]; }?> required>

                        <button type="submit" name="submit" value="Update Client Info">Update Information</button>

                        <!-- Modify the action name - value pair -->
                        <input type="hidden" name="action" value="UpdateClientInfo">

                        <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">

                </form>

<!------------------------------------------------------------------------------>

                <form class="container" method="post" action="/cit336/acme/accounts/index.php">

                    
                        <label><b>Change Password</b></label>
                        <input type="password" placeholder="Enter Password" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        <button type="submit" name="submit" value="Update Password">Update Information</button>

                        <!-- Modify the action name - value pair -->
                        <input type="hidden" name="action" value="UpdateClientPassword">

                        <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">
                  

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
