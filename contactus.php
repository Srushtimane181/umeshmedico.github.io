<?php
// Include PHPMailer namespaces at the top of the file
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'vinay.niranjan006@gmail.com'; // Your email
        $mail->Password = 'neor libd bibf xmsc'; // Your password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom($email,$name); // Sender email
        $mail->addAddress('vinay.niranjan006@gmail.com'); // Your admin email
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "You have received a new message from the contact form.\n\n"
                    . "Name: $name\n"
                    . "Email: $email\n"
                    . "Message:\n$message";

        $mail->send();
        $success = true;
    } catch (Exception $e) {
        $error = $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }

        .contact-form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
            color: #16a085;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, textarea, button {
            width: 92%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #16a085;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            margin-top: 15px;
            text-align: center;
            color: green;
        }

        .error {
            color: red;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .footer img {
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }

        @media (max-width: 600px) {
            .contact-form-container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="contact-form-container">
        
        <form id="contactForm" method="POST" action="contactus.php">
            <h1>Contact Us</h1>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Your Name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Your Email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" placeholder="Your Message" required></textarea>

            <button type="submit">Send</button>
        </form>
        <?php if (isset($success) && $success): ?>
            <p class="message">Message sent successfully!</p>
        <?php elseif (isset($error)): ?>
            <p class="message error">Message could not be sent. Error: <?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <a href="index.php" class="btn btn-secondary btn-sm">Back</a>
    </div>
    
    <div class="footer">
        <p>
            <img src="img/mail-icon.jpg" alt="Email"> umeshmedico75@gmail.com |
            <img src="img/phone-icon.png" alt="Phone"> 9270972015, 8275152874 |
            <img src="img/whatsapp-icon.png" alt="WhatsApp"> 7666256522
        </p>
    </div>
</body>
</html>
