<?php

include 'koneksi.php';

$user = $_SESSION['user'];

if(isset($_POST['item_id'])){

    $item = $_POST['item_id'];

    $start = $_POST['start'];

    $end = $_POST['end'];

    mysqli_query($conn,
    "INSERT INTO rentals(user_id,item_id,start_date,end_date)
     VALUES('{$user['id']}','$item','$start','$end')");

    mysqli_query($conn,
    "UPDATE items
     SET status='rented'
     WHERE id='$item'");

    header("Location: dashboard.php");

}

?>