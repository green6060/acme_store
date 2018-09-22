<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function acmeConnect() {
    $server = 'localhost';
    $dbname= 'acme';
    $username = 'iClient';
    $password = 'FPRPSF5e4wMLUHzk';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
    try {
    $link = new PDO($dsn, $username, $password, $options);
    //echo 'Successful Connection!';
    return $link;
    } catch(PDOException $e) {
    header('Location: view/errordocs/500.php');
    exit;
    }
}
