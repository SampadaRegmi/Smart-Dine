<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Menu</title>
</head>
<style>
body, html {
    margin: 0;
    padding: 0;
    overflow: auto;
}

.row {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    height: 40vh;
    background-color: Orange;
    padding: 20px;
    overflow-y: auto; /* Enable vertical scrolling if content exceeds the height */
}

.col {
    width: calc(100% / 4);
    padding-top: 30px;
    margin: 10px; /* Adjust the margin to reduce space between rows */
    border-radius: 10px;
}

/* Additional styling for the upper three cards */
.row:first-child .col {
    margin-bottom: 5px; /* Adjust the margin to reduce space between upper and lower rows */
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.image-container {
    position: relative;
}

.text-overlay {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    background-color: white;
    color: black;
    padding: 10px;
    text-align: center;
    width: 100%;
    font-size: 18px;
}

.image-container:hover .image {
    transform: scale(1.1);
}

</style>
<body>
@include('User.Layouts.headerfooter')
    <div class="main-content">
        <div class="row">
            <div class="col">
                <a href="{{ url('/appetizers') }}">
                    <div class="card">
                        <div class="image-container">
                            <div class="text-overlay"><b>Appetizers</b></div>
                            <img src="/Images/appetizers.avif" class="image" style="width: 100%; height: 200px; border-radius:5px;">
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="/salads">
                    <div class="card">
                        <div class="image-container">
                            <div class="text-overlay"><b>Salads</b></div>
                            <img src="/Images/Salad.jpg" class="image" style="width: 100%; height: 200px; border-radius:5px;">
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="/entree">
                    <div class="card">
                        <div class="image-container">
                            <div class="text-overlay"><b>Main Course</b></div>
                            <img src="/Images/maincourse.jpg" class="image" style="width: 100%; height: 200px; border-radius:5px;">
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a href="/drinks">
                    <div class="card">
                        <div class="image-container">
                            <div class="text-overlay"><b>Drinks</b></div>
                            <img src="/Images/drinks.jpg" class="image" style="width: 100%; height: 200px; border-radius:5px;">
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="/desserts">
                    <div class="card">
                        <div class="image-container">
                            <div class="text-overlay"><b>Desserts</b></div>
                            <img src="/Images/desserts.jpeg" class="image" style="width: 100%; height: 200px; border-radius:5px;">
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="/combos">
                    <div class="card">
                        <div class="image-container">
                            <div class="text-overlay"><b>Combos</b></div>
                            <img src="/Images/combo.jpg" class="image" style="width: 100%; height: 200px;border-radius:5px;">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>

