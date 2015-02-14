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
if($_SESSION["admin"] == 1){
    if(isset($_POST['give-out']))
    {
        date_default_timezone_set('Europe/Tallinn');
        $date = date('Y-m-d H:i:s', time());
        $return_date = date('Y-m-d H:i:s', strtotime("+7 days"));

        $give_out_new = $connection->query("INSERT INTO `issuetracker`.`user_books` (`id`, `user_id`, `book_id`, `given_out`, `estimated_return`, `actual_return`) VALUES (NULL, '". $_POST["name_ids"] ."', '". $_GET['book_id'] ."', '". $date ."', '". $return_date ."', '')");


        header("Location: /raamatukoi/books-out.php");
    }
}



?>