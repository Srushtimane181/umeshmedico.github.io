<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'umeshmedico');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$order_id = $_POST['order_id'];
$status = $_POST['status'];

// Fetch order details
$query = "SELECT o.id, o.name, o.email, o.number, o.payment_method, o.address, o.city, o.state, 
                 o.country, o.pin_code, o.order_date, o.status, o.delivery_charge,
                 GROUP_CONCAT(CONCAT(oi.product_name, ' (', oi.quantity, ')') SEPARATOR ', ') AS products,
                 (SUM(oi.product_price * oi.quantity) + o.delivery_charge) AS total_amount
          FROM orders o
          JOIN order_items oi ON o.id = oi.order_id
          WHERE o.id = ?
          GROUP BY o.id";
$stmt = mysqli_prepare($conn, $query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $email, $number, $payment_method, $address, $city, $state, 
                            $country, $pin_code, $order_date, $order_status, $delivery_charge, $products, $total_amount);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Database error: Unable to fetch order details.'); window.location.href='uorder.php';</script>";
    exit();
}

// Update order status
$update_query = "UPDATE orders SET status = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $update_query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "si", $status, $order_id);
    if (mysqli_stmt_execute($stmt)) {

        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'vinay.niranjan006@gmail.com'; // Your Gmail
            $mail->Password = 'rkvt mcmq idtv mvpi'; // App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email details
            $mail->setFrom('vinay.niranjan006@gmail.com', 'Umesh Medico');
            $mail->addAddress($email, $name);
            $mail->Subject = "Order Status Updated - Order #$order_id";
            $mail->isHTML(true);

            // Email Body with Order Details
            $mail->Body = "
                <h2>Hello $name,</h2>
                <p>Your order (ID: <b>$order_id</b>) status has been updated to <b>$status</b>.</p>
                <h3>Order Details:</h3>
                <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>
                    <tr><td><b>Order ID</b></td><td>$id</td></tr>
                    <tr><td><b>Name</b></td><td>$name</td></tr>
                    <tr><td><b>Email</b></td><td>$email</td></tr>
                    <tr><td><b>Phone</b></td><td>$number</td></tr>
                    <tr><td><b>Payment Method</b></td><td>$payment_method</td></tr>
                    <tr><td><b>Address</b></td><td>$address, $city, $state, $country - $pin_code</td></tr>
                    <tr><td><b>Order Date</b></td><td>$order_date</td></tr>
                    <tr><td><b>Delivery Charge</b></td><td>₹" . number_format($delivery_charge, 2) . "</td></tr>
                    <tr><td><b>Products</b></td><td>$products</td></tr>
                    <tr><td><b>Total Amount</b></td><td><b>₹" . number_format($total_amount, 2) . "</b></td></tr>
                </table>
                <br>
                <p>Thank you for shopping with us!</p>
                <p><b>Umesh Medico</b></p>
            ";

            // Send email
            $mail->send();
        } catch (Exception $e) {
            echo "<script>alert('Order updated, but email could not be sent. Error: {$mail->ErrorInfo}'); window.location.href='uorder.php';</script>";
            exit();
        }

        echo "<script>alert('Order status updated successfully and email sent to user!'); window.location.href='uorder.php';</script>";
    } else {
        echo "<script>alert('Failed to update order status. Please try again.'); window.location.href='uorder.php';</script>";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Database error: Unable to prepare statement.'); window.location.href='uorder.php';</script>";
}

// Close connection
mysqli_close($conn);
?>
