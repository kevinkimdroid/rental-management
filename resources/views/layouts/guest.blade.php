<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1a68a5">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}?v=6">
</head>
<body>
    @php
        $isRegister = request()->routeIs('register');
        $isLogin = request()->routeIs('login');
    @endphp

    <div class="auth-page">
        <aside class="auth-visual">
            <div class="auth-visual-bg">
                @if (file_exists(public_path('images/auth-property.jpg')))
                    <img src="{{ asset('images/auth-property.jpg') }}" alt="">
                @endif
                <div class="auth-visual-overlay"></div>
            </div>

            <div class="auth-visual-inner">
                <a href="{{ url('/') }}" class="auth-logo">
                    @include('partials.brand-logo')
                </a>

                <div class="auth-visual-content">
                    @if ($isRegister)
                        <h2>Start managing your properties today</h2>
                        <p>Join landlords who replaced spreadsheets with one clear system for rent, tenants, and maintenance.</p>
                    @else
                        <h2>Welcome back — your portfolio awaits</h2>
                        <p>Sign in to track rent, tenants, and maintenance from your dashboard.</p>
                    @endif

                    <div class="auth-perks">
                        <div class="auth-perk">
                            <span class="auth-perk-icon">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Z"/></svg>
                            </span>
                            <div><strong>Properties & units</strong><span>Track every building and room</span></div>
                        </div>
                        <div class="auth-perk">
                            <span class="auth-perk-icon">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                            <div><strong>Rent & payments</strong><span>Record collections in KES</span></div>
                        </div>
                        <div class="auth-perk">
                            <span class="auth-perk-icon">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                            </span>
                            <div><strong>Live dashboard</strong><span>Occupancy and rent at a glance</span></div>
                        </div>
                    </div>

                    <div class="auth-visual-stats">
                        <div class="auth-stat"><strong>6</strong><span>Modules</span></div>
                        <div class="auth-stat"><strong>Free</strong><span>To start</span></div>
                        <div class="auth-stat"><strong>2 min</strong><span>Setup</span></div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="auth-main">
            <div class="auth-main-bg" aria-hidden="true">
                <span class="auth-blob auth-blob-1"></span>
                <span class="auth-blob auth-blob-2"></span>
                <span class="auth-blob auth-blob-3"></span>
            </div>

            <div class="auth-deco" aria-hidden="true">
                <div class="auth-deco-grid">
                    <span class="auth-deco-icon" style="--d:0"><svg viewBox="0 0 24 24" fill="#4285F4"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/></svg></span>
                    <span class="auth-deco-icon" style="--d:1"><svg viewBox="0 0 24 24" fill="#1a68a5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></span>
                    <span class="auth-deco-icon" style="--d:2"><svg viewBox="0 0 24 24" fill="#64748b"><path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z"/></svg></span>
                    <span class="auth-deco-icon" style="--d:3"><svg viewBox="0 0 24 24" fill="#f59e0b"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></span>
                    <span class="auth-deco-icon" style="--d:4"><svg viewBox="0 0 24 24" fill="#8b5cf6"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg></span>
                    <span class="auth-deco-icon" style="--d:5"><svg viewBox="0 0 24 24" fill="#ef4444"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg></span>
                </div>
            </div>

            <div class="auth-form-wrap">
                <a href="{{ url('/') }}" class="auth-mobile-logo">
                    @include('partials.brand-logo', ['height' => 36])
                </a>

                @if ($isLogin || $isRegister)
                    <nav class="auth-tabs">
                        <a href="{{ route('login') }}" class="auth-tab {{ $isLogin ? 'active' : '' }}">Sign in</a>
                        <a href="{{ route('register') }}" class="auth-tab {{ $isRegister ? 'active' : '' }}">Register</a>
                    </nav>
                @endif

                <div class="auth-card">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
