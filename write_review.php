<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: user/form1/login.php');
    exit();
}

$userId = $_SESSION['user'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];

    // Insert the review into the database
    $insertQuery = "INSERT INTO reviews (user, name, rating, message) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($insertQuery);
    $stmt->bind_param('isis', $userId, $name, $rating, $message);
    $stmt->execute();

    header('Location: r1.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Review</title>
    <style>
        /* White and Green Theme */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        nav {
            background-color: var(--white);
            padding: 15px;
            text-align: center;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav a {
            text-decoration: none;
            color:#777;
            margin: 0 15px;
            font-weight: bold;
        }
nav a:hover{
    color:#16a085;
}
        h1 {
            text-align: center;
            margin: 30px 0;
            font-size: 28px;
            color:#777;
        }
h1:hover{
    color:#16a085;
}
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
            color: #777;
        }

        input, select, textarea {
            width: 92%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        button {
            background-color: #16a085;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color:   #218838;
        }
    </style>
</head>
<body>

    <nav>
        <a href="index.php">Home</a>
        <a href="r1.php">Reviews</a>
        <a href="write_review.php">Write a Review</a>
    </nav>

    <h1>Write a Review</h1>
    <form method="POST" action="write_review.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="rating">Rating:</label>
        <select id="rating" name="rating" required>
            <option value="">--Select--</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
