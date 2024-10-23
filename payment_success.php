<?php
if (isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];

    // Save payment ID and other order details to the database
    // Redirect to the success or order confirmation page

    echo "Payment successful! Your Payment ID is: " . $payment_id;
} else {
    echo "Payment failed or canceled!";
}
