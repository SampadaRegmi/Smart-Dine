@extends('User.Layouts.headerfooter')

@section('content')
<style>
    html {
      font-size: 16px;
    }

    .cd__main {
      min-height: 100vh;
      padding: 0.5rem;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #222;
      font-size: 1.5rem;
      background-size: 7rem 7rem, 6rem 6rem, auto;
    }

    .wrapper {
      width: 100%; 
      max-width: 530px; 
      padding: 1rem; 
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      margin:auto;
      border-radius: 0.5rem; 
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      background-color: rgba(255, 255, 255, 0.9);
      margin-top: 2.5rem;
    }

    .wrapper .title {
      font-weight: bold;
      font-size: 1.2rem;
    }

    .rate-box {
      display: flex;
      flex-direction: row-reverse;
      gap: 0.5rem;
    }

    .rate-box input {
      display: none;
    }

    .rate-box input:hover ~ .star:before {
      color: rgb(245, 215, 23);
    }

    .rate-box input:checked ~ .star:before {
      color: #f3d31e;
    }

    .rate-box .star:before {
      content: "★";
      font-size: 2rem;
      cursor: pointer;
      color: #0000;
      background-color: #aaa;
      background-clip: text;
    }

    textarea {
      border: 2px solid #050505;
      width: 100%;
      padding: 0.2rem;
      border-radius: 0.1rem;
      box-shadow: inset 2px 2px 8px rgba(0, 0, 0, 0.3);
    }

    .submit-btn {
      padding: 0.2rem 0.5rem;
      border-radius: 1rem;
      cursor: pointer;
      background-color: rgb(80, 160, 0);
    }

    .success-message {
      text-align: center;
      margin-top: 1rem;
      color: green;
      font-weight: bold;
    }
</style>

<main class="cd__main">
    <form class="wrapper" action="{{ route('review.submit', ['orderId' => $orderId]) }}" id="reviewForm" method="POST">
      <div class="title">Rate your experience</div>
      <div class="content">We highly value your feedback!</div>
      <div class="rate-box">
        <input type="radio" name="star" id="star0" value="5"/>
        <label class="star" for="star0"></label>
        <input type="radio" name="star" id="star1" value="4"/>
        <label class="star" for="star1"></label>
        <input type="radio" name="star" id="star2" value="3" checked="checked"/>
        <label class="star" for="star2"></label>
        <input type="radio" name="star" id="star3" value="2"/>
        <label class="star" for="star3"></label>
        <input type="radio" name="star" id="star4" value="1"/>
        <label class="star" for="star4"></label>
      </div>
        <textarea name="comment" cols="30" rows="6" placeholder="Tell us about your experience!"></textarea>
        @csrf
        <input type="hidden" name="order_id" value="{{ $orderId }}">
        <!-- Iterate over each menu item in the array -->
        @foreach($menu as $menuItem)
            <input type="hidden" name="menu_ids[]" value="{{ $menuItem['id'] }}">
        @endforeach
        <input type="hidden" name="user_id" value="{{ optional($user)['id'] }}">
        <button type="submit" class="button-submit">Submit</button>
    </form>

    @if(session('success'))
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          alert("Thank you for your review!");
        });
      </script>
    @endif
</main>
@endsection
