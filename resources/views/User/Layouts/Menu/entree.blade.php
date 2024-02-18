<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <title>Menu</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            overflow: auto;
        }

        .row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(calc(25% - 20px), 1fr));
            gap: 20px;
            background-color: Orange;
            padding: 20px;
            overflow-y: auto; /* Enable vertical scrolling if content exceeds the height */
        }

        .col {
            margin: 10px;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            box-sizing: border-box; /* Add this property to include padding and border in the width calculation */
        }

        .col img {
            width: 100%;
            height: 200px;
            border-radius: 5px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .image-container {
            position: relative;
        }

        .overlay {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.8);
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }

        .col:hover .overlay {
            bottom: 0;
            height: 100%;
        }

        .text {
            color: black;
            font-size: 18px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .image-container:hover .image {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    @include('User.Layouts.headerfooter')
    <div class="main-content">
        @php $index = 0; @endphp
        @foreach($menuItems as $menuItem)
            @if($index % 4 == 0)
                <!-- Start a new row after every 4 items -->
                <div class="row">
            @endif
            <div class="col">
                <div class="card">
                    <div class="image-container">
                        <img src="{{ $menuItem->image }}" class="image" style="border-radius: 5px;">
                        <div class="overlay">
                            <div class="text">
                                <b>{{ $menuItem->name }}</b><br>
                                <p>{{ $menuItem->description }}</p>
                                <p>Price: {{ $menuItem->price }}</p>
                                <a href="{{ route('add-cart', ['id' => $menuItem->id]) }}">
                                    <button style="background-color: green; color: white;">Add to Cart</button>
                                </a>
                                <!-- You can add additional elements like food category dropdown here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(($index + 1) % 4 == 0 || $loop->last)
                <!-- End the current row after every 4 items or at the last item -->
                </div>
            @endif
            @php $index++; @endphp
        @endforeach
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cols = document.querySelectorAll('.col');

            cols.forEach(col => {
                const hammer = new Hammer(col);
                hammer.on('tap', function () {
                    toggleOverlay(col);
                });
            });
        });

        function toggleOverlay(element) {
            // Toggle the visibility of the overlay
            const overlay = element.querySelector('.overlay');
            overlay.style.height = overlay.style.height === '0px' ? '100%' : '0px';
        }
    </script>
</body>
</html>
