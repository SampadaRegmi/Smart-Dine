<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Include external CSS -->
    <link rel="stylesheet" href="{{ asset('Authentication/style.css') }}">

    <!-- Include external JS -->
    <script src="{{ asset('Authentication/index.js') }}"></script>
</head>

<style>
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

<body>
    <div class="container">
        <div class="slider"></div>
        <div class="btn">
            <button class="login">Login</button>
            <button class="signup">Register</button>
        </div>
        <div class="form-section">
            <div class="login-box">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                        <i class="toggle-password" onclick="togglePassword(this)">&#128065;</i>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </form>
            </div>
            <div class="signup-box">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                        <input type="text" class="form-control" name="phone" id="phone"required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                        <i class="toggle-password" onclick="togglePassword(this)">&#128065;</i>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                        <i class="toggle-password" onclick="togglePassword(this)">&#128065;</i>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include external JS -->
    <script>
        // Function to toggle password visibility
        function togglePassword(icon) {
            const passwordField = icon.previousElementSibling;
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            icon.innerHTML = type === 'password' ? '👁' : '👁‍🗨';
        }

        // Error Modal functions
        function openErrorModal(errors) {
            const modal = document.createElement('div');
            modal.className = 'modal';

            const modalContent = document.createElement('div');
            modalContent.className = 'modal-content';
            modalContent.innerHTML = `
                <span class="close-btn" onclick="closeErrorModal()">&times;</span>
            `;

            for (const field in errors) {
                if (field === 'email' || field === 'password') {
                    modalContent.innerHTML += `<p>${errors[field][0]}</p>`;
                }
            }

            modal.appendChild(modalContent);
            document.body.appendChild(modal);
            modal.style.display = 'flex';
        }

        function closeErrorModal() {
            const modal = document.querySelector('.modal');
            modal.style.display = 'none';
            document.body.removeChild(modal);
        }

        // Check if there are errors to display on page load
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                openErrorModal({!! json_encode($errors->messages()) !!});
            @endif
        });
    </script>
    <!-- Error Modal -->
    <div id="errorModal" class="modal"></div>
</body>
</html>
