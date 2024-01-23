<?php
include 'connect.php';
if (isset($_GET['removeid'])) {
    $id = $_GET['removeid'];

    $sql = "DELETE FROM `products` WHERE `products`.`ID` = $id";    // delete product by id
    $result = mysqli_query($conn,$sql);
    if ($result) {
        // echo "product removed successfully";
        header('location:display.php');
    } else {
        die(mysqli_error($conn));
    }
}

?>