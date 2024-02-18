<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Home </title>
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {}
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
        }
        
        a,
        a:active,
        a:focus {
            color: #6f6f6f;
            text-decoration: none;
            transition-timing-function: ease-in-out;
            -ms-transition-timing-function: ease-in-out;
            -moz-transition-timing-function: ease-in-out;
            -webkit-transition-timing-function: ease-in-out;
            -o-transition-timing-function: ease-in-out;
            transition-duration: .2s;
            -ms-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -webkit-transition-duration: .2s;
            -o-transition-duration: .2s;
        }
        
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        section {
            padding: 60px 0;
        }

        .sec-title {
            position: relative;
            z-index: 1;
            margin-bottom: 60px;
        }

        .sec-title .title {
            position: relative;
            display: block;
            font-size: 18px;
            line-height: 24px;
            color: #00aeef;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .sec-title h2 {
            position: relative;
            display: block;
            font-size: 40px;
            line-height: 1.28em;
            color: #222222;
            font-weight: 600;
            padding-bottom: 18px;
        }

        .sec-title h2:before {
            position: absolute;
            content: '';
            left: 0px;
            bottom: 0px;
            width: 50px;
            height: 3px;
            background-color: #d1d2d6;
        }

        .sec-title .text {
            position: relative;
            font-size: 16px;
            line-height: 26px;
            color: #848484;
            font-weight: 400;
            margin-top: 35px;
        }

        .sec-title.light h2 {
            color: #ffffff;
        }

        .sec-title.text-center h2:before {
            left: 50%;
            margin-left: -25px;
        }

        .list-style-one {
            position: relative;
        }

        .list-style-one li {
            position: relative;
            font-size: 16px;
            line-height: 26px;
            color: #222222;
            font-weight: 400;
            padding-left: 35px;
            margin-bottom: 12px;
        }

        .list-style-one li:before {
            content: "\f058";
            position: absolute;
            left: 0;
            top: 0px;
            display: block;
            font-size: 18px;
            padding: 0px;
            color: #ff2222;
            font-weight: 600;
            -moz-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1.6;
            font-family: "Font Awesome 5 Free";
        }

        .list-style-one li a:hover {
            color: #44bce2;
        }

        .btn-style-one {
            position: relative;
            display: inline-block;
            font-size: 17px;
            line-height: 30px;
            color: #ffffff;
            padding: 10px 30px;
            font-weight: 600;
            overflow: hidden;
            letter-spacing: 0.02em;
            background-color: #00aeef;
        }

        .btn-style-one:hover {
            background-color: #0794c9;
            color: #ffffff;
        }

        .about-section {
            position: relative;
            padding: 120px 0 70px;
        }

        .about-section .sec-title {
            margin-bottom: 45px;
        }

        .about-section .content-column {
            position: relative;
            margin-bottom: 50px;
        }

        .about-section .content-column .inner-column {
            position: relative;
            padding-left: 30px;
        }

        .about-section .text {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 26px;
            color: #848484;
            font-weight: 400;
        }

        .about-section .list-style-one {
            margin-bottom: 45px;
        }

        .about-section .btn-box {
            position: relative;
        }

        .about-section .btn-box a {
            padding: 15px 50px;
        }

        .about-section .image-column {
            position: relative;
        }

        .about-section .image-column .text-layer {
            position: absolute;
            right: -110px;
            top: 50%;
            font-size: 325px;
            line-height: 1em;
            color: #ffffff;
            margin-top: -175px;
            font-weight: 500;
        }

        .about-section .image-column .inner-column {
            position: relative;
            padding-left: 80px;
            padding-bottom: 0px;
        }

        .about-section .image-column .inner-column .author-desc {
            position: absolute;
            bottom: 16px;
            z-index: 1;
            background: orange;
            padding: 10px 15px;
            left: 96px;
            width: calc(100% - 152px);
            border-radius: 50px;
        }

        .about-section .image-column .inner-column .author-desc h2 {
            font-size: 21px;
            letter-spacing: 1px;
            text-align: center;
            color: #fff;
            margin: 0;
        }

        .about-section .image-column .inner-column .author-desc span {
            font-size: 16px;
            letter-spacing: 6px;
            text-align: center;
            color: #fff;
            display: block;
            font-weight: 400;
        }

        .about-section .image-column .inner-column:before {
            content: '';
            position: absolute;
            width: calc(50% + 80px);
            height: calc(100% + 160px);
            top: -80px;
            left: -3px;
            background: transparent;
            z-index: 0;
            border: 44px solid #00aeef;
        }

        .about-section .image-column .image-1 {
            position: relative;
        }

        .about-section .image-column .image-2 {
            position: absolute;
            left: 0;
            bottom: 0;
        }

        .about-section .image-column .image-2 img,
        .about-section .image-column .image-1 img {
            box-shadow: 0 30px 50px rgba(8, 13, 62, .15);
            border-radius: 46px;
        }

        .about-section .image-column .video-link {
            position: absolute;
            left: 70px;
            top: 170px;
        }

        .about-section .image-column .video-link .link {
            position: relative;
            display: block;
            font-size: 22px;
            color: #191e34;
            font-weight: 400;
            text-align: center;
            height: 100px;
            width: 100px;
            line-height: 100px;
            background-color: #ffffff;
            border-radius: 50%;
            box-shadow: 0 30px 50px rgba(8, 13, 62, .15);
            -webkit-transition: all 300ms ease;
            -moz-transition: all 300ms ease;
            -ms-transition: all 300ms ease;
            -o-transition: all 300ms ease;
            transition: all 300ms ease;
        }

        .about-section .image-column .video-link .link:hover {
            background-color: #191e34;
            color: #fff;
        }
    </style>
</head>
<body>
@include('User.Layouts.headerfooter')
    <section class="about-section">
        <div class="container">
            <div class="row">
                <!-- Text Column -->
                <div class="text-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="sec-title">
                            <span class="title">About SmartDine</span>
                            <h2>Enhancing Your Culinary Experience</h2>
                        </div>
                        <div class="text">
                            Immerse yourself in the world of culinary delight with Smart Dine. 
                            Our platform goes beyond traditional dining, offering unique features 
                            like online reservations, menu customization, secure payments, and more 
                            to enhance your dining journey.Smart Dine is a sophisticated software application 
                            crafted to assist restaurant owners and patrons in efficiently managing and enjoying 
                            various aspects of the dining experience.From reservation management to personalized menu suggestions,
                            it covers a diverse range of features.
                        </div>
                        <div class="btn-box">
                            <a href="{{ route('contact.showForm') }}" class="theme-btn btn-style-one">Contact Us</a>
                        </div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="author-desc">
                            <h2> Smart Dine</h2>
                            <span>For Your Service</span>
                        </div>
                        <figure class="image-1">
                            <a href="#" class="lightbox-image" data-fancybox="images">
                                <img src="{{ asset('/Images/about2.avif')}}" alt="Routine">
                            </a>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="sec-title">
                <h2>We Want Our Users to Be Fully Satisfied</h2>
            </div>
            <div class="text">
            This innovative smart dining system enriches the dining experience for members by seamlessly integrating various features. 
            Users can effortlessly register and log in, creating personalized profiles for a tailored experience. The system simplifies 
            the food selection process by categorizing dishes, and a user-friendly search function allows members to explore a diverse 
            range of culinary offerings. The 'Add to Cart' feature streamlines ordering, enabling users to review and modify their choices
            before confirming their dine-in or takeaway orders. Online prepayment enhances the ordering process's efficiency, providing a 
            hassle-free experience for users. Notifications confirming order details, whether for dine-in or takeaway, are sent via email, 
            ensuring a smooth and timely process. The inclusion of a ratings and reviews system maintains service integrity, while the rewarding 
            of loyalty with discounts adds an extra layer of user engagement. Lastly, the ability to view and edit user profiles allows members to 
            manage their preferences easily. Together, these features create a robust smart dining system that combines convenience, efficiency, and user engagement.
            </div>
        </div>
    </section>
</body>
</html>
