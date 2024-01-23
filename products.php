<!---data insertion--->
<?php
include 'connect.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $date = $_POST['date'];

    $sql = "INSERT INTO `products`(`Product Name`, `Use-By Date`) VALUES ('$name','$date')";    // insert new data into table, prone to sql injection - use prepared statements
    $result = mysqli_query($conn,$sql);
    if ($result) {
        // echo "product data inserted successfully";
        header('location:display.php');     //redirect to display table after insertion
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="font-awesome-pro-5\css\all.css" rel="stylesheet">

    <title>Add Product</title>

    <!---bootstrap 5.0 css--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body style="background-color: black;">

    <!---product form--->
    <div class="container" style="background-color: black; padding-top: 10%; padding-left: 5%; padding-right: 5%;">
        <h1 style="color: white;">Add New Product <i class="far fa-cheese-swiss"></i></h1>
        <form method="post">
            <div class="form-group my-5">
                <label class="form-label" style="color: white;">Product Name <i class="far fa-tag"></i></label>
                <input type="text" class="form-control" placeholder="Enter product name" name="name" autocomplete="off">
                <p style="color: grey; padding-top: 5px;">Note: product name cannot contain ' (apostrophes)</p>
            </div>
            <div class="form-group">
                <label class="form-label" style="color: white;">Use-By Date <i class="far fa-calendar-alt"></i></label>
                <input type="date" class="form-control" placeholder="Enter product's use-by date" name="date" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary my-5" name="submit">Submit</button>
            <button type="button" class="btn btn-danger my-5"><a href="display.php" style="background-color: transparent; color: white; text-decoration: none;">Cancel</a></button>
        </form>
    </div>

</body>
</html>