@extends('User.Layouts.headerfooter')
@section('content')
<link rel="stylesheet" href="{{ asset('User/Profile/style.css') }}">
<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fefefe;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        max-width: 300px; /* Set the maximum width */
        margin: auto;
    }

    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close-btn:hover {
        color: black;
    }

    body.modal-open {
        overflow: hidden;
    }

    .password-container {
        position: relative;
        display: inline-block;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
        font-size: 18px;
    }

    .toggle-password:hover {
        color: #000;
    }
</style>
    <div class="wrapper">
        <form method="POST" action="{{ route('user.updateProfile', $user->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="profile">
                <!-- Success Modal -->
                <div class="modal" id="successModal">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeModal()">&times;</span>
                        <p>{{ session('success') }}</p>
                        <button class="Btn" onclick="goBack()">Back</button>
                    </div>
                </div>
                @if(session('success'))
                    <script>
                        // Open the success modal on page load if there is a success message
                        document.addEventListener('DOMContentLoaded', function () {
                            openModal();
                        });
                    </script>
                @endif
                <div class="content">
                    <!-- Name -->
                    <fieldset>
                        <div class="grid-35">
                            <label for="name">Edit Your Name</label>
                        </div>
                        <div class="grid-65">
                            <input type="text" id="name" tabindex="2" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </fieldset>
                    <br>

                    <!-- Email -->
                    <fieldset>
                        <div class="grid-35">
                            <label for="email">Email Address</label>
                        </div>
                        <div class="grid-65">
                            <input type="email" id="email" tabindex="3" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', optional($user)->email) }}" required autocomplete="email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </fieldset>
                    <br>

                    <!-- Phone -->
                    <fieldset>
                        <div class="grid-35">
                            <label for="phone">Phone Number</label>
                        </div>
                        <div class="grid-65">
                            <input type="text" id="phone" tabindex="4" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', optional($user)->phone) }}" autocomplete="phone" />
                            @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </fieldset>
                    <br>

                    <!-- Old Password -->
                    <fieldset>
                    <div class="grid-35">
                        <label for="old_password">Old Password</label>
                    </div>
                    <div class="grid-65 password-container">
                        <input type="password" id="old_password" tabindex="1" class="form-control password-field @error('old_password') is-invalid @enderror" name="old_password" autocomplete="current-password" required />
                        <i class="toggle-password" onclick="togglePassword(this)">&#128065;</i>
                        @error('old_password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    </fieldset>
                    <br>

                    <!-- Confirm New Password -->
                    <fieldset>
                    <div class="grid-35">
                        <label for="new_password_confirmation">New Password</label>
                    </div>
                    <div class="grid-65 password-container">
                        <input type="password" id="new_password_confirmation" tabindex="6" class="form-control password-field" name="new_password_confirmation" autocomplete="new-password" />
                        <i class="toggle-password" onclick="togglePassword(this)">&#128065;</i>
                    </div>
                    </fieldset>
                    <br>

                    <!-- Buttons -->
                    <fieldset>
                        <input type="button" class="Btn cancel" value="Back" onclick="window.location.href='{{ route('home') }}'" />
                        <input type="submit" class="Btn" value="Save Changes" />
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('User/Profile/script.js') }}"></script>
    <script>
        function togglePassword(icon) {
            const passwordField = icon.previousElementSibling;
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            icon.innerHTML = type === 'password' ? '&#128065;' : '&#128064;';
        }

        function openModal() {
            document.getElementById('successModal').style.display = 'flex';
            document.body.classList.add('modal-open');
        }

        function closeErrorModal() {
            const modal = document.querySelector('.modal');
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
        }
    </script>
    
    <script>
        function goBack() {
            // Redirect to the homepage
            window.location.href = '{{ route('home') }}';
        }
    </script>
@endsection
