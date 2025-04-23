<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Carousel</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        /* body {
    background-image: url('th1.jpeg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
} */

        body {
            background-color: #2c3e50;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            height: auto;
            background-image: url('img/th3.jpeg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
        }

        .carousel {
            position: relative;
            width: 700px;
            height: 600px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
            z-index: 3;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 100%;
        }

        .card {
            min-width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        .card img {
            width: 699px;
            height: 350px;
            object-fit: cover;
            border-bottom: 2px solid #2980b9;
        }

        .card .info {
            padding: 20px;
            color: #333;
            text-align: left;
            overflow-y: auto;
        }

        .card .info h3 {
            margin-bottom: 15px;
            font-size: 24px;
            color: #2980b9;
        }

        .card .info p {
            margin: 5px 0;
            font-size: 16px;
        }

        .card .info a {
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }

        .card .info a:hover {
            text-decoration: underline;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            cursor: pointer;
            z-index: 2;
            opacity: 0.7;
        }

        .arrow:hover {
            opacity: 1;
        }

        .left {
            left: 20px;
        }

        .right {
            right: 20px;
        }

        @media (max-width: 600px) {
            .carousel {
                width: 90%;
                height: auto;
            }

            .card .info {
                padding: 15px;
            }

            .arrow {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="carousel">
    <button class="close-btn" onclick="closeCarousel()">X</button>
    <button class="arrow left" onclick="prevSlide()">&#8592;</button>
    <div class="slides" id="slides">
        <div class="card">
            <img src="uploadphoto/aboutus.jpg" alt="Medical Store">
            <div class="info">
                <h3>Umesh Medico</h3>
                <p><strong>Address:</strong>Sanjivani ayurvedic chikistalya Midc road kupwad</p>
                <p><strong>Landmark:</strong> RP Patil Chawk</p>
                <p><strong>Contact:</strong> 9270972015</p>
                <p><strong>Email:</strong> umeshmedico75@gmail.com</p>
                <p><strong>Operating Hours:</strong> Mon-Sat: 8:00 AM – 11:00 PM | Sun: 9:00 AM – 6:00 PM</p>
             
            </div>
        </div>
        <div class="card">
            <img src="uploadphoto/aboutus.jpg" alt="Grocery Store">
            <div class="info">
                <h3>Yash Medical & Gen stores</h3>
                <p><strong>Address:</strong>Near Old Church Midc road kupwad</p>
                <p><strong>Landmark:</strong>NEar old church</p>
                <p><strong>Contact:</strong> 8275152874</p>
                <p><strong>Email:</strong> yashmedical45@gmail.com</p>
        
                <p><strong>Operating Hours:</strong> 7:00 AM – 10:00 PM (Mon-Sun)</p>
        
            </div>
        </div>
        <div class="card">
            <img src="uploadphoto/aboutus.jpg" alt="Electronics Store">
            <div class="info">
                <h3>Umesh medical and gen stores</h3>
                <p><strong>Address:</strong>Kupwad vikas sciety building,main road kupwad</p>
                <p><strong>Landmark:</strong>Vikas Society</p>
                <p><strong>Contact:</strong>7666256522</p>
              
             
                <p><strong>Operating Hours:</strong> 10:00 AM – 8:00 PM (Mon-Sat)</p>
              
            </div>
        </div>
    </div>
    <button class="arrow right" onclick="nextSlide()">&#8594;</button>
</div>

<script>
    let currentIndex = 0;

    function showSlide(index) {
        const slides = document.getElementById('slides');
        const totalSlides = document.querySelectorAll('.card').length;
        if (index >= totalSlides) {
            currentIndex = 0;
        } else if (index < 0) {
            currentIndex = totalSlides - 1;
        } else {
            currentIndex = index;
        }
        const translateValue = -currentIndex * 100 + '%';
        slides.style.transform = `translateX(${translateValue})`;
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    function prevSlide() {
        showSlide(currentIndex - 1);
    }

    function closeCarousel() {
        window.location.href = 'index.php';
    }
</script>

</body>
</html>
