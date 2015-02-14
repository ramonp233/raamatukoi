<?php
session_start();
include("database.php");
if($_SESSION["admin"] == 1){
    if(isset($_POST['delete_submit']))
    {
        date_default_timezone_set('Europe/Tallinn');
        $date = date('Y-m-d H:i:s', time());

        $date_update = $connection->query("UPDATE user_books
                    SET actual_return='". $date ."'
                    WHERE id='". $_GET['id'] ."'");
        echo $date . " " . $_GET['id'];
        header("Location: /raamatukoi/books-out.php");
    }
}



?>