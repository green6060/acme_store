<?php
if(!isset($_SESSION['loggedin'])){
    header('Location: /cit336/acme/');
    exit;
};
?>
    <!DOCTYPE html>
    <html lang="en-us">

    <head>
        <meta charset="utf-8">
        <meta name="description" content="Short page description.">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width">
        <title id="title">Home</title>
        <link rel="stylesheet" href="/cit336/acme/support/css/styles.css" media="screen">
    </head>

    <body>
        <div id="wrapper">

            <header id="header">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/cit336/acme/modules/header.php'; ?>
            </header>

            <main id="main">
                <h1 class=pageTitle>
                    <?php echo $_SESSION['clientData']['clientFirstname']; ?>
                    <?php echo $_SESSION['clientData']['clientLastname']; ?>
                </h1>

                <?php if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                }
?>
                <ul>
                    <li>First name:
                        <?php echo $_SESSION['clientData']['clientFirstname']; ?>
                    </li>
                    <li>Last Name:
                        <?php echo $_SESSION['clientData']['clientLastname']; ?>
                    </li>
                    <li>Email:
                        <?php echo $_SESSION['clientData']['clientEmail']; ?>
                    </li>

                    <li><a href="/cit336/acme/accounts/index.php?action=ClientUpdate">Update Account Information</a></li>
                </ul>

                <?php if($_SESSION['clientData']['clientLevel'] > 1){
                    echo '<h2 class=pageTitle>Administrative Functions</h2>';
                    echo '<ul><li><a href="../products/">Add a New Product</a></li></ul>';
                };?>



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
