<?php
// Database connection
$con = mysqli_connect('localhost', 'root', '', 'umeshmedico');

// Check if connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the total number of users from tbluser
$user_count_query = mysqli_query($con, "SELECT COUNT(*) AS total_users FROM tbluser");
$user_count_result = mysqli_fetch_assoc($user_count_query);
$total_users = $user_count_result['total_users'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .icons-container .icons:hover p {
            color: #0e6655;
        }
        .icons-container .icons:hover p {
            text-decoration: none;
        }
        /* Styles for the Branches button */
        .icons-container .icons button {
            background-color: white; /* White background */
            color: var(--green); /* Green text */
            border: 2px solid var(--green); /* Green border */
            padding: 0.5rem 1.5rem;
            font-size: 1.6rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .icons-container .icons button a {
            color: var(--green);
            text-decoration: none;
            font-weight: bold;
        }

        .icons-container .icons button:hover {
            background-color: var(--green); /* Green background */
            color: white; /* White text */
        }

        .icons-container .icons button:hover a {
            color: white; /* Change link color to white */
        }
    </style>
</head>
<body>
    <div class="page-content"> 
        <!-- header section starts here -->
        <header class="header">
            <a href="#" class="logo"><i class="fas fa-heartbeat"></i> Umesh Medico</a>
            <nav class="navbar">
                <a href="#home">Home</a>
                <a href="user/header1.php">Products</a>
                <a href="adminindex.php">Admin</a>
                <a href="contactus.php">Contact Us</a>
                <a href="r1.php">Review</a>
                <a href="blogs.php">Blogs</a>
            </nav>
            <div id="menu-btn" class="fas fa-bars"></div>
        </header>
    </div>

    <!-- home section starts here -->
    <section class="home" id="home">
        <div class="image">
            <img src="img/dr2.jpg" alt="img not found">
        </div>
        <div class="content">
            <h3>Stay Safe, Stay Healthy</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit ducimus sunt facere dolores reiciendis eaque.</p>
            <a href="contactus.php" class="btn">Contact Us <span class="fas fa-chevron-right"></span></a>
        </div>
    </section>

    <!-- icons section starts here -->
    <section class="icons-container">
        <div class="icons">
            <i class="fas fa-user-md"></i>
            <h3>20+</h3>
            <p>Workers at Work</p>
        </div>

        <div class="icons">
            <i class="fas fa-ambulance"></i>
            <h3>24/7</h3>
            <p>Service</p>
        </div>

        <div class="icons">
            <i class="fas fa-hospital"></i>
            <h3>3+</h3>
            <button><a href="branch.php">Branches</a></button>
        </div>

        <div class="icons">
            <i class="fas fa-users"></i>
            <h3><?php echo $total_users; ?>+</h3> <!-- Dynamically display total users -->
            <p>Happy Customers</p>
        </div>
    </section>


    <!-- service section starts here -->
    <section class="services" id="services">
        <h1 class="heading">our <span>services</span></h1>
        <div class="box-container">
            <div class="box">
                <i class="fas fa-notes-medical">
                    <h3>Experts Consultancy</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, cumque!</p>
                    <!-- <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span></a> -->
                </i>
            </div>
            <div class="box">
                <i class="fas fa-pills">
                    <h3>Medicines</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, cumque!</p>
                    <!-- <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span></a> -->
                </i>
            </div>
            <div class="box">
                <i class="fas fa-heartbeat">
                    <h3>Total Care</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, cumque!</p>
                    <!-- <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span></a> -->
                </i>
            </div>
            <div class="box">
                <i class="fas fa-ambulance">
                    <h3>24/7 service</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, cumque!</p>
                    <!-- <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span></a> -->
                </i>
            </div>
        </div>
     </section>
    <!-- service section endss here -->

<!-- about section starts here -->
 <section class="about" id="about">
    <h1 class="heading"> <span>about</span> us </h1>
    <div class="row">
        <div class="image">
            <img src="img/aboutus.jpg" alt="img shodhaaaaaaaa">
        </div>

        <div class="content">
            <h3>We  Take  Care Of  Your  Healthy Life</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Omnis doloremque sequi animi obcaecati! Aspernatur ratione nulla dolore animi soluta magnam, temporibus hic cupiditate tempore rem quo harum accusantium, eos facilis.</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis magnam odit aut repellat aliquam laudantium id expedita veritatis voluptatum qui!</p>
            <!-- <a href="#" class="btn">learn more<span class="fas fa-chevron-right"></span></a> -->
        </div>
    </div>
 </section>
<!-- about section endss here -->






    <!-- icons section ends here -->

    <script src="script.js"></script>
</body>
</html>
