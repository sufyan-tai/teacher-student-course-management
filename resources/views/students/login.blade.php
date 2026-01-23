<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">
        <p class="subtitle">Login</p>

        @if(session('error'))
            <div class="error-box">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Enter email"
                       class="@error('email') error-input @enderror">
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group password-group">
                <label>Password</label>

                <div class="password-box">
                    <input type="password"
                           name="password"
                           id="password"
                           placeholder="6 digit password"
                           class="@error('password') error-input @enderror">

                    <span class="toggle-pass" onclick="togglePassword()">👁️</span>
                </div>

                @error('password') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-primary">Login</button>
        </form>

    </div>
</div>

<script>
function togglePassword() {
    const pass = document.getElementById('password');
    pass.type = pass.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>
