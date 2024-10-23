<?php
session_start();
include("conn.php");

// Calculate bill details (assuming you have the rates set)
$cartSubtotal = 0; // Initialize subtotal
$vat_rate = 0.12; // Example VAT rate
$shipping = 0; // Example shipping cost


// Initialize an array to store product names and quantities
$productsAndQuantities = [];

// Assuming you have a way to calculate cartSubtotal based on items in the cart
foreach ($_SESSION['cart'] as $item) {
    $cartSubtotal += $item['price'] * $item['quantity']; // Calculate subtotal


    $productsAndQuantities[] = [
        'name' => $item['name'],
        'quantity' => $item['quantity'],
        'cartSubtotal'=> $cartSubtotal
    ];
}

// Store calculated values in session
$_SESSION['cartSubtotal'] = $cartSubtotal;
$_SESSION['vat'] = $cartSubtotal * $vat_rate;
$_SESSION['orderTotal'] = $cartSubtotal + $_SESSION['vat'] + $shipping;
$_SESSION['product_quantity'] =$productsAndQuantities;


?>

<!doctype html>
<html lang="en">
<?php include("head.php"); ?>

<body>
    <header>
        <?php include("header.php"); ?>
        <h1>Cart Products</h1>
    </header>
    <main>
        <div class="container">
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>

                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <?php
                        $i = 1;
                        $cartSubtotal = 0;
                        foreach ($_SESSION['cart'] as $key => $items):
                            $itemTotal = $items['price'] * $items['quantity'];
                            $cartSubtotal += $itemTotal;
                            $_SESSION['product_item'] = $items['name'];
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><img src="uploads/<?= $items['image'] ?>" alt="img" width="50px" height="50px"></td>
                                <td><?= $items['name'] ?></td>
                                <td class="item-price d-none" id="item-price-<?= $key ?>"><?= $items['price'] ?></td> <!-- Kept static price here -->
                                <td id="item-total-<?= $key ?>"><?= number_format($itemTotal, 2) ?></td>
                                <td>
                                    <input type="number" min="1" value="<?= $items['quantity'] ?>" style="width:50px; text-align:center;" onchange="updateCart(<?= $key ?>, this.value)">
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Your cart is empty!</p>
            <?php endif; ?>
        </div>


        <!-- Bill Details Section -->
        <div class="bill_container container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h3>Bill Details</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Cart Subtotal:</strong></td>
                                <td id="cart-subtotal">Rs.<?= number_format($cartSubtotal, 2) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Shipping and Handling:</strong></td>
                                <td>Free</td>
                            </tr>
                            <tr>
                                <td><strong>TAX:</strong></td>
                                <td id="vat">Rs.<?= number_format($_SESSION['vat'], 2) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Order Total:</strong></td>
                                <td id="order-total"><strong>Rs.<?= number_format($_SESSION['orderTotal'], 2) ?></strong></td>
                            </tr>
                            <tr>
                                <td><button type="submit" class="btn btn-success"><a href="checkout.php" class="text-white text-decoration-none">Place Order</a></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <footer></footer>

    <script>
        // Function to update cart and recalculate prices
        function updateCart(itemKey, newQuantity) {
            // Get the price of the item
            let priceElement = document.querySelector(`#item-price-${itemKey}`);
            let price = parseFloat(priceElement.innerText);

            // Calculate new total for this item
            let itemTotal = price * newQuantity;
            document.getElementById(`item-total-${itemKey}`).innerText = itemTotal.toFixed(2);

            // Recalculate and update subtotal, VAT, and order total
            let cartItems = document.querySelectorAll("#cart-items tr");
            let cartSubtotal = 0;

            cartItems.forEach((row, index) => {
                let quantity = parseInt(row.querySelector("input[type=number]").value);
                let price = parseFloat(row.querySelector(".item-price").innerText);
                cartSubtotal += price * quantity;
            });

            let vat = cartSubtotal * <?= $vat_rate ?>;
            let orderTotal = cartSubtotal + vat + <?= $shipping ?>;

            // Update the bill details
            document.getElementById("cart-subtotal").innerText = "Rs." + cartSubtotal.toFixed(2);
            document.getElementById("vat").innerText = "Rs." + vat.toFixed(2);
            document.getElementById("order-total").innerText = "Rs." + orderTotal.toFixed(2);
        }
    </script>

</body>

</html>