<!--  ======= it will categories products how much products available particular category -->


<?php
include("conn.php");

if (isset($_GET['category_id'])) {
    $cat_id = $_GET['category_id'];
    $sql = "SELECT * FROM `products` WHERE `category_id`='$cat_id'";
    $res = mysqli_query($conn, $sql);
}

?>
<!doctype html>
<html lang="en">

<!-- head -->
<?php include("head.php"); ?>

<body>
    <header>
        <?php include("header.php"); ?>
        <h1>Category Products</h1>
    </header>
    <main>
        <div class="container product_container">
            <div class="row">
                <?php
                $cat_id = $_GET['category_id'];
                $sql = "SELECT * FROM `products` WHERE `category_id`='$cat_id'";
                $res = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    $pro_name = $row['product_name'];
                    $pro_desc = $row['product_desc'];
                    $price = $row['price'];
                    $image = $row['image'];
                    $c_id = $row['category_id'];
                    $p_id = $row['product_id'];

                ?>
                    <div class="col-lg-4">
                        <div class="card" style="width: 20rem; margin-left:20px; margin-top:30px;">
                            <img src="uploads/<?= $image ?>" class="card-img-top" alt="..." height="300px">
                            <div class="card-body">
                                <h5 class="card-title"><?= $pro_name ?></h5>
                                <p class="card-text"><?= $pro_desc ?></p>
                                <p class="card-text"><?= $price ?></p>
                                <a href="product-detail.php?id=<?= $p_id ?>" class="btn btn-primary">click me</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
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