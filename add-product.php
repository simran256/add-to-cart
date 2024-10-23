<?php

include("conn.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Add Products</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <style>
        form input,
        select,
        button {
            margin-top: 16px;
        }

        .form_container {
            background-image: radial-gradient(circle 588px at 31.7% 40.2%, rgba(225, 200, 239, 1) 21.4%, rgba(163, 225, 233, 1) 57.1%);
            padding: 15px 20px;
            border-radius: 10px;
            margin: 100px auto;
            width: 50%;
        }
    </style>
</head>

<body>

    <main>
        <form action="" class="container form_container" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Product Name" class="form-control">
            <input type="number" name="price" placeholder="Price" class="form-control">
            <input type="text" name="desc" placeholder="Description" class="form-control">
            <input type="file" name="image" class="form-control">
            <select name="category_id" id="" class="form-control">
                <option value="" disabled selected>select-category</option>
                <?php
                $sql = "select category_name, category_id from category";
                $res = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    $cat_id = $row['category_id'];
                    $cat_name = $row['category_name'];

                ?>
                    <option value="<?= $cat_id ?>">
                        <?= $cat_name ?>
                    </option>
                <?php
                }
                ?>
            </select>

            <button class="btn btn-primary" name="submit">Submit</button>

        </form>

    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>


<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $category = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $uploads = "uploads/".$image;

    move_uploaded_file($temp_name,$uploads);

    $sql = "INSERT INTO `products`(`product_name`, `product_desc`, `price`, `image`, `category_id`) 
    VALUES ('$name','$desc','$price','$image','$category')";
    $res = mysqli_query($conn,$sql);
    if($res){
       header("location: view-product.php");
    }
    else{
        echo "<script>alert('failed to insert') </script>";

    }
}

















?>