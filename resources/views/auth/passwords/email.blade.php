<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Include external CSS -->
    <link rel="stylesheet" href="{{ asset('Authentication/style.css') }}">

    <!-- Styles from the first HTML -->
    <style>
        /* Paste the styles from the first HTML here */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        /* Customize the appearance of the error messages */
        .modal-content p {
            color: #ff0000;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
    <div class="form-section">
            <div class="login-box">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Paste the button from the first HTML here -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include external JS -->
    <script src="{{ asset('Authentication/index.js') }}"></script>
</body>

</html>
