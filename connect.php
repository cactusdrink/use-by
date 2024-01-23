<?php

$conn=new mysqli('localhost', 'root', null, 'productexpirations');  // connect to my local host database

if (!$conn) {
    die(mysqli_error($conn));
}

?>