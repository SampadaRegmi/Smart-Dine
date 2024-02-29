@extends('User.Layouts.headerfooter')
@section('content')
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Contact Us</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

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
            max-width: 300px;
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
        }

        .button-submit {
            background-color: #333;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        .dialog-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
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
            <h1>Feedback</h1>
            <img src="{{ asset('Images/connect.png') }}" alt="connect">
            <h3>Phone: <span>987-654-4310</span></h3>
            <h3>Email: <span>abc@xyz.com</span></h3>
            <h3>Address: <span>123 Street</span></h3>
            <h3>Fax: <span>555-444-111</span></h3>
        </div>

        <!-- Contact Form -->
        <div>
            <h1>Stay Connected</h1>
            <form id="feedbackForm" method="post" action="{{ route('contact.submit') }}">
                @csrf
                <input name="name" type="text" class="form-input" placeholder="Name">
                <input name="email" type="text" class="form-input" placeholder="Email">
                <textarea name="text" class="form-input" placeholder="Feedback"></textarea>
                <button type="submit" class="button-submit">Submit</button>
            </form>
        </div>
        <div id="successDialog" class="dialog-box">
            <p>Thank you for your feedback!</p>
        </div>
    </section>
    <!-- Include jQuery (if not already included) -->
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

                        // You can optionally redirect the user or perform other actions here
                    },
                    error: function(error) {
                        console.log(error);
                        // Handle the error if the form submission fails
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('index.js') }}"></script>
@endsection
