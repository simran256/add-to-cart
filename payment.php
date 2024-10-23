<?php
session_start();

if (!isset($_SESSION['orderTotal']) || !isset($_SESSION['product_item']) || !isset($_SESSION['product_quantity'])) {
    header('Location: checkout.php');
    exit();
}

// Razorpay API key (replace with your key)
$razorpay_key = "YOUR_RAZORPAY_KEY_ID";

$order_total = $_SESSION['orderTotal'] * 100; // Razorpay works in paisa (so multiply by 100)

// Store additional data
$customer_name = "Customer Name"; // Replace this with your customer name logic
$customer_email = "customer@example.com"; // Replace with customer email logic
$customer_phone = "1234567890"; // Replace with customer phone number
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment with Razorpay</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>

    <h1>Complete Your Payment</h1>

    <button id="rzp-button">Pay Now</button>

    <script>
        var options = {
            "key": "<?php echo $razorpay_key; ?>", // Razorpay key ID
            "amount": "<?php echo $order_total; ?>", // Amount in paisa (1 INR = 100 paisa)
            "currency": "INR",
            "name": "<?php echo $customer_name; ?>",
            "description": "Order Payment",
            "image": "https://your_logo_url.com", // Optional: Add your logo URL here
            "handler": function(response) {
                alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
                window.location.href = "payment_success.php?payment_id=" + response.razorpay_payment_id;
            },
            "prefill": {
                "name": "<?php echo $customer_name; ?>",
                "email": "<?php echo $customer_email; ?>",
                "contact": "<?php echo $customer_phone; ?>"
            },
            "theme": {
                "color": "#F37254"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>

</body>

</html>