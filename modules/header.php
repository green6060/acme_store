<!-- 
 * The Modularized Header, to be reused.
 *
-->
<!-- REQUIRES file to: Run functions we've created for the purpose of server-side validation
-->
<nav>    
    <div class="flex-container">               
            <div class="flex-item">
                <img src="/cit336/acme/images/site/logo.png">
            </div>
            <div class="flex-item">
                <?php if(isset($cookieFirstname)){
                    echo "<h2><a href='/cit336/acme/view/admin/'>Welcome $cookieFirstname</a></h2>";                    
                } ?>
            </div>
            <div class="flex-item">
                <?php
if(isset($_SESSION['loggedin']) && $_SESSION['clientData']['clientLevel'] > 2){
    echo '<a href="/cit336/acme/accounts/index.php/?action=admin">Settings</a>';
};
?>
            </div>
        </div>
    <?php echo $navList;?>
    <?php if (isset($_SESSION['loggedin'])){        
        echo '<li><a href="/cit336/acme/accounts/index.php?action=logout" title="Logout">Logout</a></li></ul>';
} else { 
    echo '<li><a href="/cit336/acme/accounts/index.php?action=login" title="Access the Accounts controller">My Account</a></li></ul>';
};?>
</nav>
