<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
            <h1 class="pageTitle">Login</h1>
            <h2>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
            </h2>
            <form class="container" action="/cit336/acme/accounts/index.php" method="post">

                <span>All fields required!</span>

                <br>

                <label for="clientEmail"><b>Email</b></label>

                <br>

                <input type="email" placeholder="Enter email " name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                <br>

                <span> Must include: at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span>

                <br>

                <label for="clientPassword"><b>Password</b></label>

                <br>

                <input type="password" placeholder="Enter Password " name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

                <button type="submit">Login</button>
                <input type="hidden" name="action" value="loginAcnt">

                <button><a href="../accounts/index.php?action=register">Register for an Account</a></button>

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
