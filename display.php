<?php
include 'connect.php';
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

    <title>Current Products</title>

    <!---bootstrap 5.0 css--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body style="background-color: black;">
        <!---sticky header--->
        <div class="sticky-header" id="sticky-header" style="background-color: black; display: flex; justify-content:space-between;">
            <div class="header-title" style="padding-top: 16px;">
                    <h1 style="color: white;"><i class="far fa-shopping-basket"></i> My Basket</h1>
            </div>
            <div class="timestamp" style="padding-top: 16px;">
                <h2 style="color: white;"><i class="fas fa-sun-cloud"></i><?php echo date(" l d/m/Y") ?></h1>
            </div>

            <!---sticky scroll javascript--->
            <script>
                window.onscroll = function() {myFunction()};

                var header = document.getElementById("sticky-header");

                var sticky = header.offsetTop;

                function myFunction() {
                if (window.pageYOffset > sticky) {
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticky");
                }
                }
            </script>
        </div>

    <h2 style="color: white; padding-left: 7%; margin-top: 3%;"><i class="far fa-list"></i> Current Products</h2>

    <!---product table--->
    <div class="container" style="background-color: black; padding-bottom: 200px;">

        <!---sort by option--->
        <div class="container my-3" style="display: flex; justify-content:space-between; align-items: center;">

            <!---add product button--->
            <button class="btn btn-primary"><a href="products.php" class="text-light" style="text-decoration: none; background-color: transparent;">Add Product <i class="far fa-plus" style="background-color: transparent;"></i></a></button>
        
            <form action="" method="get">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <select name="sort" class="form-control">
                                <option value="a-z" <?php if (isset($_GET['sort']) && $_GET['sort'] == "a-z"){ echo "selected"; } ?> style="background-color: transparent;">Product Name: A to Z</option>
                                <option value="z-a" <?php if (isset($_GET['sort']) && $_GET['sort'] == "z-a"){ echo "selected"; } ?> style="background-color: transparent;">Product Name: Z to A</option>
                                <option value="newest" <?php if (isset($_GET['sort']) && $_GET['sort'] == "newest"){ echo "selected"; } ?> style="background-color: transparent;">Use-By Date: Newest</option>
                                <option value="oldest" <?php if (isset($_GET['sort']) && $_GET['sort'] == "oldest"){ echo "selected"; } ?> style="background-color: transparent;">Use-By Date: Oldest</option>
                            </select>
                            <button type="submit" class="input-group-text btn btn-primary" id="basicaddon2">Sort <i class="far fa-sort-alt" style="background-color: transparent;"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        
        <table class="table table-dark table-hover table-bordered" style="background-color: black;">
            <thead>
                <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Use-By Date</th>
                <th scope="col">. . .</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

            <!---sort & display data--->
            <?php
            $sort_by = null;    
            $column = "`Product Name`";     // default sorting option is a-z

            if (isset($_GET["sort"])) {
                if ($_GET["sort"] == "a-z") {
                    $column = "`Product Name`";
                    $sort_by = "ASC";
                } else if ($_GET["sort"] == "z-a") {
                    $column = "`Product Name`";
                    $sort_by = "DESC";
                } else if ($_GET["sort"] == "newest") {
                    $column = "`Use-By Date`";
                    $sort_by = "DESC";
                } else if ($_GET["sort"] == "oldest") {
                    $column = "`Use-By Date`";
                    $sort_by = "ASC";
                }
            }
            $sql = "SELECT * FROM `products` ORDER BY $column $sort_by";    // select by sorting options
            $result = mysqli_query($conn,$sql);

            if (mysqli_num_rows($result) > 0) {
                $current_date = date('Y-m-d');
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['ID'];
                    $name = $row['Product Name'];
                    $date = $row['Use-By Date'];
                    if ($date < $current_date) {    // if product's use-by date has passed
                        echo ' <tr class="table-danger">
                        <td style="font-weight: bold;"><span style="background-color: transparent;">EXPIRED: </span>'.$name.'</td>
                        <td style="font-weight: bold;">'.$date.'</td>
                        <td>
                            <button class="btn btn-primary"><a href="edit.php?editid='.$id.'" class="text-light" style="text-decoration: none; background-color: transparent;">Edit <i class="far fa-pencil" style="background-color: transparent;"></i></a></button>
                            <button class="btn btn-danger"><a href="remove.php?removeid='.$id.'" class="text-light" style="text-decoration: none; background-color: transparent;">Remove <i class="far fa-minus" style="background-color: transparent;"></i></a></button>
                        </td>
                    </tr>';
                    } else {
                        echo ' <tr>
                        <td>'.$name.'</td>
                        <td>'.$date.'</td>
                        <td>
                            <button class="btn btn-primary"><a href="edit.php?editid='.$id.'" class="text-light" style="text-decoration: none; background-color: transparent;">Edit <i class="far fa-pencil" style="background-color: transparent;"></i></a></button>
                            <button class="btn btn-danger"><a href="remove.php?removeid='.$id.'" class="text-light" style="text-decoration: none; background-color: transparent;">Remove <i class="far fa-minus" style="background-color: transparent;"></i></a></button>
                        </td>
                    </tr>';
                    }
                }
            } else {
                ?>
                <tr>
                    <!---when there are no products in basket--->                
                    <td colspan="3" style="text-align: center; font-size: 24px;">Nothing Yet ..<i class="far fa-cookie-bite"></i></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>