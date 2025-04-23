<?php
// Your API Key (get this from your NewsAPI account)
$apiKey = '601a8b42fce94c9380e58f25248ebd83'; 

// URL to get medical-related news
$url = "https://newsapi.org/v2/everything?q=medical&apiKey=$apiKey";

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set a timeout in case the request takes too long

// Set the User-Agent header
curl_setopt($ch, CURLOPT_USERAGENT, 'MedicalNewsApp/1.0 (https://yourwebsite.com)');

// Execute the cURL request and fetch the response
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Decode the JSON response
    $newsData = json_decode($response, true);
    
    // Check if we have a successful response
    if (isset($newsData['status']) && $newsData['status'] == 'ok') {
        if (isset($newsData['articles']) && count($newsData['articles']) > 0) {
            echo "<h1>Latest Medical News</h1>";
            // Loop through the articles and display them
            foreach ($newsData['articles'] as $article) {
                echo "<div class='blog-post'>";
                
                // Display image if available
                if (isset($article['urlToImage']) && !empty($article['urlToImage'])) {
                    echo "<img src='" . htmlspecialchars($article['urlToImage']) . "' alt='Article Image' class='article-image'>";
                }

                echo "<h2>" . htmlspecialchars($article['title']) . "</h2>";
                echo "<p><em>By " . htmlspecialchars($article['author']) . " on " . $article['publishedAt'] . "</em></p>";
                echo "<p>" . nl2br(htmlspecialchars($article['description'])) . "</p>";
                echo "<a href='" . htmlspecialchars($article['url']) . "' target='_blank'>Read more</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No articles found. Please try again later.</p>";
        }
    } else {
        // Display the error message from the API
        echo '<p>API Error: ' . (isset($newsData['message']) ? $newsData['message'] : 'Unknown error') . '</p>';
    }
}

// Close the cURL session
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Medical News</title>
    <style>
        /* General Body and Layout Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #16a085;
        }

        .blog-post {
            background-color: white;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
        }

        .blog-post h2 {
            font-size: 24px;
            color: #333;
            margin: 10px 0;
        }

        .blog-post p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        .blog-post a {
            display: inline-block;
            margin-top: 10px;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .blog-post a:hover {
            text-decoration: underline;
        }
        .btn-secondary {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
}
element.style {
    position: absolute;
    top: 10px;
    right: 10px;
}

        /* Image Styling */
        .article-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .blog-post {
                width: 95%;
                padding: 15px;
            }

            .blog-post h2 {
                font-size: 22px;
            }

            .blog-post p {
                font-size: 14px;
            }

            .article-image {
                width: 100%;
                height: auto;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 22px;
            }

            .blog-post h2 {
                font-size: 20px;
            }

            .blog-post p {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
<a href="index.php" class="btn btn-secondary" style="position: absolute; top: 10px; right: 10px; text-decoration : none; display: inline-block;
    font-weight: 400;
      font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: center;
    
    vertical-align: middle;
    cursor: pointer;
   
    text: white;
    color: #fff;
    padding: .375rem .75rem;
    font-size: 1rem;">Back</a>


    <!-- The PHP code above will generate the dynamic content here -->
</body>
</html>
