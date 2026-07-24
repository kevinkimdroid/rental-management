@php
    $manifestPath = public_path('build/manifest.json');
    $cssFile = null;
    $jsFile = null;

    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true) ?? [];
        $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
        $jsFile = $manifest['resources/js/app.js']['file'] ?? null;
    }
@endphp

@if ($cssFile)
    <link rel="stylesheet" href="{{ asset('build/'.$cssFile) }}">
@endif

@if ($includeJs ?? false)
    @if ($jsFile)
        <script src="{{ asset('build/'.$jsFile) }}" defer></script>
    @endif
@endif
