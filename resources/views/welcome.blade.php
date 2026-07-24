<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rental property management for landlords and property managers. Track properties, tenants, leases, rent, and maintenance in one place.">
    <meta name="theme-color" content="#1a68a5">
    <title>{{ config('app.name') }} — Rental Property Management</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v=18">
</head>
<body>

<header class="header" id="header">
    <div class="container header-inner">
        <div class="header-start">
            <a href="{{ url('/') }}" class="logo">
                @include('partials.brand-logo')
            </a>
            <nav class="menu" aria-label="Primary">
                <a href="#features" class="menu-link">Features</a>
                <a href="#modules" class="menu-link">Modules</a>
            </nav>
        </div>
        <div class="header-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="link-signin">Sign in</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Get started</a>
            @endauth
        </div>
    </div>
</header>

<main>

    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-copy">
                <h1>Property management that stays out of your way</h1>
                <p>{{ config('app.name') }} keeps your properties, tenants, leases, and rent payments in one calm workspace — so you spend less time on admin and more on your portfolio.</p>
                <div class="hero-actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Open dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create free account</a>
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-lg">Sign in</a>
                    @endauth
                </div>
                <div class="hero-links">
                    <a href="{{ route('register') }}" class="hero-link">
                        <span class="hero-link-icon" aria-hidden="true">✓</span>
                        <span class="hero-link-text">
                            <strong>Free to start</strong>
                            <span>Full access, no card required</span>
                        </span>
                    </a>
                    <a href="#modules" class="hero-link">
                        <span class="hero-link-icon" aria-hidden="true">KES</span>
                        <span class="hero-link-text">
                            <strong>Rent in KES</strong>
                            <span>Track payments locally</span>
                        </span>
                    </a>
                    <a href="#features" class="hero-link">
                        <span class="hero-link-icon" aria-hidden="true">6</span>
                        <span class="hero-link-text">
                            <strong>Six modules</strong>
                            <span>Properties to maintenance</span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="hero-photo">
                <div class="hero-photo-frame">
                    <img src="{{ asset('images/hero-property.jpg') }}" alt="Modern residential property" width="640" height="480" loading="eager">
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="container">
            <div class="section-intro section-intro-center">
                <h2>Built for landlords who manage real buildings</h2>
                <p>Not a generic business app — every screen is designed around how rental portfolios actually work day to day.</p>
            </div>
            <div class="feature-grid">
                <article class="feature-card">
                    <div class="feature-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                    </div>
                    <h3>See everything clearly</h3>
                    <p>Occupancy, rent due, and open maintenance tickets on one screen — no digging through files.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                    </div>
                    <h3>Records that connect</h3>
                    <p>Properties link to units, units to tenants, tenants to leases and payments — one chain, no duplicate entry.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3>Less time on admin</h3>
                    <p>Log a payment, update a lease, or close a repair ticket in seconds — from any device with a browser.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="modules" id="modules">
        <div class="container">
            <div class="section-intro section-intro-center">
                <h2>Everything in one platform</h2>
                <p>Six modules that share the same data — add a tenant once and they appear everywhere they need to.</p>
            </div>
            <div class="modules-grid">
                <article class="module-card">
                    <span class="module-num">01</span>
                    <h3>Properties</h3>
                    <p>Register buildings with address, type, and description.</p>
                </article>
                <article class="module-card">
                    <span class="module-num">02</span>
                    <h3>Units</h3>
                    <p>Track unit numbers, rent, bedrooms, and occupancy status.</p>
                </article>
                <article class="module-card">
                    <span class="module-num">03</span>
                    <h3>Tenants</h3>
                    <p>Store contacts, ID numbers, and lease history per tenant.</p>
                </article>
                <article class="module-card">
                    <span class="module-num">04</span>
                    <h3>Leases</h3>
                    <p>Manage start dates, deposits, monthly rent, and lease status.</p>
                </article>
                <article class="module-card">
                    <span class="module-num">05</span>
                    <h3>Payments</h3>
                    <p>Record rent in KES and track paid, pending, and overdue.</p>
                </article>
                <article class="module-card">
                    <span class="module-num">06</span>
                    <h3>Maintenance</h3>
                    <p>Log repairs, set priority, and close tickets when done.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="quote">
        <div class="container quote-inner">
            <figure>
                <blockquote>&ldquo;I used to juggle three Excel files for my buildings. Now I open one dashboard and know exactly who owes rent and what needs fixing.&rdquo;</blockquote>
                <figcaption>
                    <cite>James Kariuki</cite>
                    <span>Property manager · Nairobi · 11 units</span>
                </figcaption>
            </figure>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <div class="cta-box">
                <h2>Ready to simplify your rentals?</h2>
                <p>Create a free account and explore the full platform with sample data.</p>
                <div class="cta-actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-white btn-lg">Go to dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-white btn-lg">Create free account</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-white btn-lg">Sign in</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

</main>

<footer class="footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <a href="{{ url('/') }}" class="logo">
                @include('partials.brand-logo', ['height' => 38])
            </a>
            <p>Rental property management for landlords, agents, and portfolio managers.</p>
        </div>
        <div class="footer-col">
            <h4>Product</h4>
            <a href="#features">Features</a>
            <a href="#modules">Modules</a>
        </div>
        <div class="footer-col">
            <h4>Account</h4>
            <a href="{{ route('login') }}">Sign in</a>
            <a href="{{ route('register') }}">Register</a>
            @auth<a href="{{ route('dashboard') }}">Dashboard</a>@endauth
        </div>
    </div>
    <div class="container footer-copy">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</div>
</footer>

<script>
(function () {
    var header = document.getElementById('header');
    window.addEventListener('scroll', function () {
        header.classList.toggle('is-scrolled', window.scrollY > 8);
    }, { passive: true });
})();
</script>
</body>
</html>
