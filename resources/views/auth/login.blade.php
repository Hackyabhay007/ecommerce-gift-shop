<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Include Bootstrap CSS or your preferred styling -->
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
