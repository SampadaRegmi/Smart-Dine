@extends('User.Layouts.headerfooter')
@section('content')
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Contact Us</title>
    <style>
        /* Contact section styles */
        #contact {
            display: flex;
            justify-content: space-around;
            padding: 40px 0;
        }

        #contact div {
            flex: 1;
            padding: 0 20px;
        }

        #contact h1 {
            font-size: 30px;
            margin-bottom: 20px;
        }

        #contact img {
            width: 100%;
            max-width: 1000px;
            padding: 10px 0;
        }

        #contact h3 {
            padding: 2px;
            font-size: 18px;
        }

        #contact span {
            font-weight: 100;
            margin-left: 5px;
        }

        /* Form styles */
        form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .button-submit {
            background-color: #333;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 10px;
        }

        /* Center the "Stay Connected" heading */
        .stay-connected {
            text-align: center;
            margin-bottom: 20px; 
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            #contact {
                flex-direction: column;
            }

            #contact div {
                padding: 0;
                margin-bottom: 20px;
            }
        }
    </style>
    <section id="contact">
        <!-- Phone number and address -->
        <div>
            <img src="{{ asset('Images/connect.png') }}" alt="connect">
        </div>

        <!-- Contact Form -->
        <div>
            <h1 class="stay-connected">Stay Connected</h1> <!-- Moved and centered here -->
            <form id="feedbackForm" method="post" action="{{ route('contact.submit') }}">
                @csrf
                <input name="name" type="text" class="form-input" placeholder="Name">
                <input name="email" type="text" class="form-input" placeholder="Email">
                <textarea name="text" class="form-input" placeholder="Feedback"></textarea>
                <button type="submit" class="button-submit">Submit</button>
            </form>
        </div>
    </section>
    <!-- Include jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#feedbackForm').submit(function(event) {
                // Prevent the form from submitting in the traditional way
                event.preventDefault();

                // Reference to the form
                var form = $(this);

                // Perform an AJAX request to submit the form data
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        // Display the success dialog
                        $('#successDialog').css('display', 'block');
                        // Display alert message
                        alert('Thank you for your feedback!');
                    },
                    error: function(error) {
                        console.log(error);
                        // Handle the error if the form submission fails
                    }
                });
            });
        });
    </script>
@endsection
