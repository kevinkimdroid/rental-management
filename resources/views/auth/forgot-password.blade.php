<x-guest-layout>
    <a href="{{ route('login') }}" class="auth-back">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to sign in
    </a>

    <div class="auth-heading">
        <h1>Reset password</h1>
        <p>We will email you a link to choose a new password</p>
    </div>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf
        <div class="auth-field">
            <label for="email">Email address</label>
            <div class="auth-input-group">
                <span class="auth-input-icon">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </span>
                <input id="email" type="email" name="email" class="auth-input" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
            </div>
            @error('email')<p class="auth-error">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="auth-submit">Send reset link</button>
    </form>
</x-guest-layout>
