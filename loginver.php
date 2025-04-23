<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'umeshmedico');

$A_name = $_POST['username'];
$A_password = $_POST['userpassword'];

$result = mysqli_query($con, "SELECT * FROM `admin` WHERE username='$A_name' AND userpassword='$A_password'");

if (mysqli_num_rows($result)) {
    $_SESSION['admin_session'] = $A_name;
    echo "
        <script>
            alert('Login successful');
            window.location.href='mystore.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Invalid details');
            window.location.href='adminindex.php';
        </script>
    ";
}
?>
