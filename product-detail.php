<?php
include("conn.php");
session_start();

if (isset($_GET['id'])) {
    $p_id = $_GET['id'];
    $sql = "SELECT * FROM `products` WHERE `product_id`='$p_id'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $image = $row['image'];
        $p_name = $row['product_name'];
        $p_desc = $row['product_desc'];
        $price = $row['price'];
    } else {
        echo "Product not found.";
        exit();
    }
}

if (isset($_POST['add_to_cart'])) {
    $cart_item = [
        'id' => $p_id,
        'name' => $p_name,
        'image' => $image,
        'price' => $price,
        'quantity' => 1
    ];

    // Initialize the cart session if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;

    // Check if product is already in the cart
    foreach ($_SESSION['cart'] as &$items) {
        if ($items['id'] == $p_id) {
            // Increase quantity and update price
            $items['quantity'] += 1;
            $items['price'] += $price;
            $found = true;
            break;
        }
    }

    // If product was not found in the cart, add it
    if (!$found) {
        $_SESSION['cart'][] = $cart_item;
    }

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("location: register.php");
        exit();
    }

    header('location: cart.php');
    exit();
}
?>

<!doctype html>
<html lang="en">

<!-- head -->
<?php include("head.php"); ?>

<body>
    <header>
        <!-- head -->
        <?php include("header.php"); ?>
        <h1>Category Product Detail Page</h1>
    </header>
    <main>
        <div class="product_container container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="width: 30rem; margin-left:20px; margin-top:30px;">
                        <img src="uploads/<?= $image ?>" class="card-img-top" alt="..." height="300px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $p_name ?></h5>
                            <p class="card-text"><?= $p_desc ?></p>
                            <form method="post" action="">
                                <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>