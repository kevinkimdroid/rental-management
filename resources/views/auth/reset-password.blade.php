<x-guest-layout>
    <div class="auth-heading">
        <h1>Set a new <em>password</em></h1>
        <p>Choose a strong password for your account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field">
            <label for="email">Your Email</label>
            <input id="email" type="email" name="email" class="auth-input" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            @error('email')<p class="auth-error">{{ $message }}</p>@enderror
        </div>

        <div class="auth-field">
            <label for="password">New Password</label>
            <input id="password" type="password" name="password" class="auth-input" required autocomplete="new-password">
            @error('password')<p class="auth-error">{{ $message }}</p>@enderror
        </div>

        <div class="auth-field">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="auth-input" required autocomplete="new-password">
            @error('password_confirmation')<p class="auth-error">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="auth-submit">Reset password</button>
    </form>

    <p class="auth-footer"><a href="{{ route('login') }}">Back to sign in</a></p>
</x-guest-layout>
