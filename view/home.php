<!doctype html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <title class="pageTitle">Home | ACME Rocket</title>
    <meta name="description" content="Acme Weapons Page, supplying all of your roadrunner catching supplies.">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/cit336/acme/support/css/styles.css" media="screen">

</head>

<body>
    
    <div id="wrapper">
        
        

        <header id="header">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/cit336/acme/modules/header.php'; ?>
        </header>
        <main>
            <section>
                <h1 class=pageTitle>Welcome to Acme!</h1>
                <article id="acmeRocket">
                    <ul id="wantitNow">
                        <li>
                            <h2>Acme Rocket</h2>
                        </li>
                        <li>Quick lighting fuse</li>
                        <li>NHTSA approved seat belts</li>
                        <li>Mobile launch stand included</li>
                        <li><a href="#"><img id="actnbtn" alt="Action Button" src="images/site/iwantit.gif"></a></li>
                    </ul>
                </article>
                <div id="boxes">
                    <article id="productReview">
                        <h3>Acme Rocket Reviews</h3>
                        <ul>
                            <li>"I don't know how I ever caught roadrunners before this." (9/10)</li>
                            <li>"That thing was fast!" (4/5)</li>
                            <li>"Talk about fast delivery." (5/5)</li>
                            <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                            <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                        </ul>
                    </article>
                    <article>
                        <h3 id="recipesTitle">Featured Recipes</h3>
                        <div id="recipes">
                            <div id="recipebox1">
                                <p id="bbq"></p>
                                <a id="bbqText" href="#" title="Pulled Roadrunner BBQ">Pulled Roadrunner BBQ</a>
                                <p id="pie"></p>
                                <a href="#" title="Roadrunner Pot Pie"> Roadrunner Pot Pie</a>
                            </div>

                            <div id="recipebox2">
                                <p id="soup"></p>
                                <a href="#" title="Soup">Roadrunner Soup</a>
                                <p id="taco"></p>
                                <a href="#" title="Roadrunner Tacos">Roadrunner Tacos</a>
                            </div>
                        </div>
                    </article>
                </div>
            </section>

            <section id="productContent">
                <h1 id="productTitle"></h1>
                <article id="productBoxes">
                    <div id="image"></div>
                    <div id="productInfo">
                        <p id="description"></p>
                        <p id="manufacturer"> </p>
                        <p id="reviews"> </p>
                        <p id="price"> </p>
                    </div>
                </article>
            </section>
        </main>
        <footer id="pageFooter">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/cit336/acme/modules/footer.php'; ?>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    
</body>

</html>
