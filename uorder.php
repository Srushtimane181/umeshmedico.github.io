<?php
$conn = mysqli_connect('localhost', 'root', '', 'umeshmedico');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a search query is set
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

// Modify query to filter by exact name match if a search query is provided
$query = "SELECT o.id, o.user_name ,o.name, o.email, o.number, o.payment_method, o.address, o.city, o.state, o.country, o.pin_code, o.order_date, o.status, o.prescription_file,
                 GROUP_CONCAT(CONCAT(oi.product_name, ' (', oi.quantity, ')') SEPARATOR ', ') AS products,
                 (SUM(oi.product_price * oi.quantity) + o.delivery_charge) AS total_amount
          FROM orders o
          JOIN order_items oi ON o.id = oi.order_id";

if (!empty($searchQuery)) {
    $query .= " WHERE o.user_name = '" . mysqli_real_escape_string($conn, $searchQuery) . "'";
}

$query .= " GROUP BY o.id ORDER BY o.id DESC";

$result = mysqli_query($conn, $query);

echo "<h2 style='text-align:center; color:#16a085;'>All Orders</h2>";
echo"<a href='mystore.php' class='btn btn-success'  text:  #0e6655; style='position: absolute; top: 10px; right: 10px;'>Back</a>";

// Search form
echo "<form method='GET' action='' style='text-align:center; margin-bottom: 20px;'>
        <input type='text' name='search' placeholder='Enter Username' value='" . htmlspecialchars($searchQuery) . "' required>
        <button type='submit' style='background-color:#16a085; color:white; padding:5px; border:none; cursor:pointer;'>Search</button>
        <a href='uorder.php' style='margin-left:10px; text-decoration:none; background-color:#6c757d; color:white; padding:5px; border-radius:3px;'>Reset</a>
      </form>";

echo "<table border='1' cellspacing='0' cellpadding='5' style='border-collapse:collapse; width:100%; text-align:center;'>
        <thead>
        <tr style='background-color:#16a085; color:white;'>
            <th>Order ID</th>
            <th>User Name</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Payment Method</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Pin Code</th>
            <th>Prescription File</th>
            <th>Products</th>
            <th>Total Amount (₹)</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Update Status</th>
            <th>Delete</th>
        </tr>
        </thead>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['user_name']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['number']}</td>
            <td>{$row['payment_method']}</td>
            <td>{$row['address']}</td>
            <td>{$row['city']}</td>
            <td>{$row['state']}</td>
            <td>{$row['country']}</td>
            <td>{$row['pin_code']}</td>";

    // Show prescription file if uploaded
    if (!empty($row['prescription_file'])) {
        $prescriptionPath = 'user/' . $row['prescription_file'];
        echo "<td><a href='{$prescriptionPath}' target='_blank' style='color:blue;'>View File</a></td>";
    } else {
        echo "<td style='color:red;'>No File</td>";
    }

    echo "<td>{$row['products']}</td>
          <td>₹" . number_format($row['total_amount'], 2) . "</td>
          <td>{$row['order_date']}</td>
          <td>{$row['status']}</td>
          <td>
              <form action='update_order_status.php' method='post'>
                  <input type='hidden' name='order_id' value='{$row['id']}'>
                  <select name='status'>
                      <option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                      <option value='Shipped' " . ($row['status'] == 'Shipped' ? 'selected' : '') . ">Shipped</option>
                      <option value='Delivered' " . ($row['status'] == 'Delivered' ? 'selected' : '') . ">Delivered</option>
                  </select>
                  <button type='submit' style='background-color:#16a085; color:white; padding:5px; border:none; cursor:pointer;'>Update</button>
              </form>
          </td>";

    // ✅ Fixed Delete button block
    echo "<td>
            <form action='' method='post' onsubmit='return confirm(\"Are you sure you want to delete this order?\");'>
                <input type='hidden' name='order_id' value='{$row['id']}'>
                <button type='submit' style='background-color:#c0392b; color:white; padding:5px; border:none; cursor:pointer;'>&#128465; Delete</button>
            </form>
          </td>";

    echo "</tr>";
}

echo "</table>";

// Delete logic at the end
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);

    // First delete from order_items to maintain foreign key integrity
    $deleteItemsQuery = "DELETE FROM order_items WHERE order_id = $order_id";
    mysqli_query($conn, $deleteItemsQuery);

    // Then delete from orders
    $deleteOrderQuery = "DELETE FROM orders WHERE id = $order_id";
    $result = mysqli_query($conn, $deleteOrderQuery);

    if ($result) {
        header("Location: uorder.php?msg=Order+Deleted");
        exit();
    } else {
        echo "Failed to delete order.";
    }
}
?>
