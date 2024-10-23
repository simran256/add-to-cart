<!-- ============= it will show all products categories only like women men kids  eg -->
<?php
include("conn.php");

?>
<!doctype html>
<html lang="en">

<!-- head -->
<?php include("head.php"); ?>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>
    <main>
        <h1>categories</h1>

        <div class="container">
            <div class="row">
                <?php
                $sql = "SELECT * FROM `category`";
                $res = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    $cat_name = $row['category_name'];
                    $cat_id = $row['category_id'];
                    $cat_desc = $row['categoey_desc'];
                 
            
                    if($cat_name == 'women'){
                        $src = "women.jpg";
                    }
                    else if($cat_name == 'mens'){
                        $src = "men.jpg";
                    }
                    else if($cat_name == 'kids'){
                        $src = "kids.jpg";
                    }
                    else{
                        $src = "accer.jpg";
                    }


                ?>
                    <div class="card col-lg-4" style="width: 20rem; margin-left:20px; margin-top:30px;">

                        <div class="card-body">
                            <img src="<?= $src ?>" class="card-img-top" alt="<?= $cat_name ?>" />
                            <h5 class="card-title"><?= $cat_name ?></h5>
                            <p class="card-text"><?= $cat_desc ?></p>
                            <a href="category-products.php?category_id=<?= $cat_id ?>" class="btn btn-primary">click me</a>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>



    </main>

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