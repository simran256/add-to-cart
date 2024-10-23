<?php
include("conn.php");
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit(); // Ensure to exit after the redirect
}
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $other_notes = $_POST['other_notes'];

    $sql = "INSERT INTO `checkout`(`fname`, `lname`, `email`, `phone_num`, `address`, `city`, `state`, `zip`, `other_note`) VALUES ('$fname','$lname','$email','$number','$address','$city','$state','$zip','$other_notes')";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        header("location: payment.php");
        exit();
    } else {
        echo "data not inserted";
    }
}
?>

<!doctype html>
<html class="no-js" lang="zxx">

<!-- head -->
<?php include("head.php"); ?>

<body>
    <div class="body-wrapper">


        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg/5.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2">
                            <div class="section-title-area ltn__section-title-2">
                                <h1 class="section-title white-color">Checkout Page</h1>
                            </div>
                            <!-- <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="<?= $site ?>index.php">Home</a></li>

                                    <li>Checkout</li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->
        <!-- WISHLIST AREA START -->
        <div class="ltn__checkout-area mb-105">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__checkout-inner">


                            <div class="ltn__checkout-single-content mt-50">
                                <h4 class="title-2">Billing Details</h4>
                                <div class="ltn__checkout-single-content-info">
                                    <form action="#" method="POST">
                                        <h6>Personal Information</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input type="text" name="fname" placeholder="First name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input type="text" name="lname" placeholder="Last name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-email ltn__custom-icon">
                                                    <input type="email" name="email" placeholder="email address" class="form-control mt-3">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-phone ltn__custom-icon">
                                                    <input type="text" name="number" placeholder="phone number" class="form-control mt-3">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-lg-12 col-md-12">
                                                <h6>Address</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-item input-item-textarea ltn__custom-icon">
                                                            <textarea placeholder="Address" class="form-control" name="address"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Town / City</h6>
                                                <div class="input-item">
                                                    <input type="text" placeholder="City" class="form-control" name="city">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <h6>State </h6>
                                                <div class="input-item">
                                                    <input type="text" placeholder="State" class="form-control" name="state">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Zip</h6>
                                                <div class="input-item">
                                                    <input type="text" placeholder="Zip" class="form-control" name="zip">
                                                </div>
                                            </div>
                                        </div>

                                        <h6>Order Notes (optional)</h6>
                                        <div class="input-item input-item-textarea ltn__custom-icon">
                                            <textarea placeholder="Notes about your order, e.g. special notes for delivery." class="form-control" name="other_notes"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="submit"> Place order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="shoping-cart-total mt-50">
                            <h4 class="title-2 mt-4">Cart Totals</h4>
                            <table class="table">
                                <tbody>
                                    <tr class="col">
                                        <?php if (isset($_SESSION['product_quantity'])) {
                                            foreach ($_SESSION['product_quantity'] as $products) {
                                                $product_name = $products['name'];
                                                $product_quan = $products['quantity'];
                                                $total = $products['cartSubtotal'];

                                        ?>
                                    <tr>
                                        <td><?php echo $product_name; ?> <strong>× <?= $product_quan ?></strong></td>

                                    </tr>

                            <?php
                                            }
                                        }
                            ?>



                            </tr>
                            <tr>
                                <td>Sub Total : Rs.<?= $total ?></td>
                            </tr>
                            <tr>
                                <td>Shipping and Handing</td>
                                <td>Rs.0.00</td>
                            </tr>
                            <tr>
                                <td>Vat</td>
                                <?php if (isset($_SESSION['vat'])): ?>
                                    <td> Rs.<?= number_format($_SESSION['vat'], 2) ?></td>
                                <?php else: ?>
                                    <td> Rs.0.00</td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td><strong>Order Total</strong></td>

                                <?php if (isset($_SESSION['orderTotal'])): ?>
                                    <td>Rs.<?= number_format($_SESSION['orderTotal'], 2) ?></td>
                                <?php else: ?>
                                    <td> Rs.0.00</td>
                                <?php endif; ?>
                                </strong>
                            </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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