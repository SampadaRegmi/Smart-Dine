@extends('User.Layouts.headerfooter')

@section('content')
    <title>Reviews</title>
    <style>
        /* Style the container */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Style the reviews */
        .review {
            background-color: #f2f2f2;
            border-radius: 5px;
            padding: 20px;
            width: 45%;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        /* Style the review image */
        .review img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        /* Style the review content */
        .review .content {
            display: flex;
            flex-direction: column;
        }

        /* Style the review name */
        .review .content h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        /* Style the review date */
        .review .content span {
            font-size: 14px;
            color: #999;
            margin-bottom: 10px;
        }

        /* Style the review paragraph */
        .review .content p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        /* Style the review button */
        .review .content button {
            background-color:#71797E;
            color: #666;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: not-allowed;
        }

        /* Style the circle rating */
        .circle-rating {
            margin-bottom: 10px;
        }

        /* Style the individual circles */
        .circle-rating .circle {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #fff; /* Light yellow color */
            border-radius: 50%;
            margin-right: 5px;
            border: 1px solid #ccc; /* Border for unselected circles */
        }

        /* Style the rated circles */
        .circle-rating .circle.selected {
            background-color: #ffc107; /* Orange color */
        }
    </style>

    <div class="container">
        @foreach ($reviews as $review)
            <div class="review">
                <div class="circle-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="circle {{ $i <= $review->rating ? 'selected' : '' }}"></span>
                    @endfor
                </div>
                <div class="content">
                    <h3>{{ $review->user->name }}</h3>
                    <span>{{ $review->created_at->format('d M Y') }}</span>
                    <p>{{ $review->comment }}</p>
                    <button disabled></button>
                </div>
            </div>
        @endforeach
    </div>
@endsection
