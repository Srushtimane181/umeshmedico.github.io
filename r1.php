<?php
session_start();
include 'config.php';

// Fetch all reviews
$reviewsQuery = "
    SELECT r.*
    FROM reviews r
    INNER JOIN (
        SELECT name, MAX(created_at) as latest_review
        FROM reviews
        GROUP BY name
    ) latest ON r.name = latest.name AND r.created_at = latest.latest_review
    ORDER BY r.created_at DESC";

$reviewsResult = $con->query($reviewsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reviews</title>
    <style>
        /* CSS Styles */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        nav {
            background-color: #fff;
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
            color: #777;
        }
        h1:hover{
    color:#16a085;
}
        ul {
            list-style: none;
            padding: 0;
            max-width: 900px;
            margin: 0 auto;
        }

        li {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        li strong {
            font-size: 20px;
            color: #222;
        }

        li small {
            display: block;
            color: #777;
            margin-top: 10px;
            font-size: 12px;
        }

        /* Review Rating Styles */
        .rating {
            color: #16a085;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .review-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 20px;
            color:  #16a085;
        }

        /* Read more link style */
        /* .read-more {
            color: #0073e6;
            font-weight: bold;
            text-decoration: none;
        }

        .read-more:hover {
            text-decoration: underline;
        } */

        @media (max-width: 768px) {
            ul {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <nav>
   
        <a href="index.php">Home</a>
        <a href="r1.php">Reviews</a>
        <a href="write_review.php">Write a Review</a>
    </nav>

    <h1>All Reviews</h1>
    <ul>
        <?php while ($review = $reviewsResult->fetch_assoc()): ?>
            <li>
                <div class="review-icon">★</div>
                <strong><?php echo htmlspecialchars($review['name']); ?></strong> 
                <span class="rating">
                    <?php echo str_repeat('★', $review['rating']); ?>
                    <?php echo str_repeat('☆', 5 - $review['rating']); ?>
                </span><br>
                <?php echo nl2br(htmlspecialchars($review['message'])); ?><br>
                <small>Reviewed on: <?php echo $review['created_at']; ?></small><br>
                <!-- <a href="#" class="read-more">Read more</a> -->
            </li>
        <?php endwhile; ?>
    </ul>

</body>
</html>
