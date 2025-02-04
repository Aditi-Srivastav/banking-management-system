<?php
session_start();
if ($_SESSION['role'] != 'nonuser') {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IERT Bank - Your Trusted Financial Partner</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080;
            color: white;
            padding: 15px 30px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .bank-name {
            font-size: 1.8em;
            font-weight: bold;
        }

        .bank-code {
            margin-left: 10px;
            font-size: 1em;
            color: #d1e7ff;
        }

        .navbar-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar-links li {
            margin-left: 20px;
        }

        .navbar-links a {
            text-decoration: none;
            color: white;
            font-size: 1em;
            transition: color 0.3s;
        }

        .navbar-links a:hover {
            color: #d1e7ff;
        }

        /* Hero Section */
        .hero {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-image: url('photo.jpg') ;
            height: 70vh;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3.5em;
            margin: 0;
        }

        .hero p {
            font-size: 1.5em;
            margin: 15px 0 30px;
        }

        .fancy-button {
            padding: 15px 40px;
            background: linear-gradient(45deg, #ff6a00, #ee0979);
            border: none;
            border-radius: 50px;
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
        }

        .fancy-button:hover {
            transform: scale(1.2);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        /* Services Section */
        .services {
            text-align: center;
            padding: 50px 20px;
            background-color: #fff;
        }

        .services h2 {
            margin-bottom: 30px;
            font-size: 2em;
            color: #004080;
        }

        .service-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .service-card {
            background-color: #f4f4f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            text-align: left;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .service-card h3 {
            color: #004080;
            font-size: 1.5em;
        }

        .service-card p {
            font-size: 1em;
            line-height: 1.5;
            color: #555;
        }

        /* Footer Section */
        .footer {
            background-color: #004080;
            color: white;
            padding: 20px 30px;
            text-align: center;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #d1e7ff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <span class="bank-name">IERT Bank</span>
            <!-- <span class="bank-code">(Code: 12345)</span> -->
        </div>
        <ul class="navbar-links">
            <li><a href="aboutus.html">About Us</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="login.html">Bank Login</a></li>
            <li><a href="#services">Services</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Welcome <?php echo "<font color=red>".$_SESSION['username']."</font>"; ?> to IERT Bank</h1>
            <p>Your Trusted Financial Partner</p>
            <a class="fancy-button" href="signuppage.html">Open Your Savings Account</a>
        </div>
    </div>

    <!-- Services Section -->
    <section class="services">
        <h2>Our Services</h2>
        <div class="service-cards">
            <div class="service-card">
                <h3>Personal Banking</h3>
                <p>Manage your savings, deposits, and loans with ease.</p>
            </div>
            <div class="service-card">
                <h3>Corporate Banking</h3>
                <p>Solutions tailored for your business growth and financial needs.</p>
            </div>
            <div class="service-card">
                <h3>24/7 Customer Support</h3>
                <p>We're here to assist you anytime, anywhere.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 IERT Bank. All rights reserved.</p>
        <p><a href="#contact">Contact Us</a> | <a href="#privacy">Privacy Policy</a></p>
    </footer>
</body>
</html>
