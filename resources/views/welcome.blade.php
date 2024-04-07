<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            padding: 35px 60px;
            background-image: linear-gradient(to bottom right, #ff7400, #fd8b17, #ffa242, #ffc367, #f9de8a);
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .main-btn {
            background-color: #060505;
            color: #fcfcfa;
            font-size: 1rem;
            padding: 15px 25px;
            text-decoration:none;
            border-radius: 20px;
        }

        .hero {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .right {
            margin-right: 45px;
        }

        .img {
            width: 400px;
            height: 400px;
            background-image: url(https://images.luminati.co.uk/app/uploads/2022/06/main-4.jpg);
            background-size: cover;
            border-radius: 5%;
            margin-left:0px;
            border-top-right-radius: 45%;
            border: 1px solid #060505;
        }

        .border1, .border2 {
            width: 350px;
            height: 420px;
            border-radius: 5%;
            border-top-right-radius: 45%;
            border: 1px solid #060505;
            position: absolute;
            top: -12px;
            left: 10px;
            z-index: -1;
        }

        .txt-box1, .txt-box2 {
            width: 190px;
            height: 90px;
            border: 1px solid #060505;
            border-radius: 5px;
            background-color: #fcfcfa;
            position: absolute;
            bottom: -40px;
            right: -40px;
            padding: 12px;
        }

        .txt-box1 h4 {
            margin-bottom: 6px;
            font-weight: 400;
        }

        .txt-box1 h6 {
            font-weight: 300;
        }

        .left h1 {
            font-weight: 900;
            font-size: 3.5rem;
        }

        .left em, .left h2 {
            font-size: 3.5rem;
            font-weight: 100;
            letter-spacing: -3px;
            line-height: 45px;
        }

        .left h2 {
            font-weight: 600;
        }

        .left p {
            margin-top: 40px;
            font-size: 1.1rem;
        }

        .check-btn {
            position: relative;
            display: flex;
            align-items: center;
            margin-top: 40px;
        }

        .check-btn p {
            font-size: 0.95rem;
            margin-left: 55px;
            margin-top: 0;
        }

        .left-circle {
            width: 55px;
            height: 55px;
            border: 1px solid #060505;
            border-radius: 50%;
        }

        .right-circle img {
            width: 55px;
            height: 55px;
            transform: rotate(135deg);
            position: absolute;
            left: 40px;
            top: 0;
        }
    </style>
</head>
<body>
<section class="hero">
    <div class="left">
        <h1>Gourmet </h1>
        <em>Bliss Begins At</em>
        <h2>Smart Dine</h2>

        <p>Experience Exceptional Dining and Enjoy Unforgettable Meals with Us</p>
        <div class="check-btn">
            <div class="left-circle"></div>
            <div class="right-circle">
                <img src="https://cdn-icons-png.flaticon.com/512/1250/1250965.png">
            </div>
            <p>Savor the Culinary Delight!</p>
        </div>
        <br>
        <br>
        <div>
            <a href="{{ route('login') }}" class="main-btn">Get Started</a>
        </div>
    </div>
    <div class="right">
        <div class="img"></div>
    </div>
</section>
</body>
</html>
