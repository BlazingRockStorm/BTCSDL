<?php
// Set up the database connection
$user = 'postgres'; 
$pass = 'password';
$db = new PDO('pgsql:dbname=guitar_shop host=localhost port=5432', $user, $pass);

?>