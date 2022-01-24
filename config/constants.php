<?php 

    //start session (json) for displaying msg when data is inserted to db
    session_start();

    //create constants to store non-repeating values
    define('SITEURL','http://localhost/food-order/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food_order_db');
    //3. execute query and save data to db
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //db connection

    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
?>