@extends('User.Layouts.headerfooter')
@section('content')
<link rel="stylesheet" href="{{ asset('User/Profile/style.css') }}">
<style>
    .page-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding-bottom: 50px;
        <?php if(isset($backgroundImage)): ?>
            background-image: url('{{ asset($backgroundImage) }}');
        <?php endif; ?>
        background-size: cover;
        background-position: center;
    }

    .profile {
        width: 50%;
        padding: 20px; /* Add padding for better visibility */
    }

    /* Password toggle */
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

    .Btn {
        padding: 8px 12px; 
        width: auto;
    }

    .cancel {
        margin-right: 15px; /* Add margin between buttons */
    }
</style>
<div class="page-container">
    <div class="profile">
        <form method="POST" action="{{ route('user.updateProfile', $user->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- Your form content here -->
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
        </form>
    </div>
</div>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert("{{ session('success') }}");
        });
    </script>
@endif
<script>
    function togglePassword(icon) {
        const passwordField = icon.previousElementSibling;
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        icon.innerHTML = type === 'password' ? '&#128065;' : '&#128064;';
    }
</script>
@endsection
