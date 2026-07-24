<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#1a68a5">
        <title>{{ config('app.name', 'Agile Rentals') }}</title>
        @include('partials.favicon')
        <x-styles :include-js="true" />
    </head>
    <body class="font-sans antialiased" x-data="{ sidebarOpen: false }">
        <div class="app-shell lg:flex">
            <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-zinc-900/50 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" style="display: none;"></div>

            @include('layouts.sidebar')

            <div class="flex min-w-0 flex-1 flex-col lg:pl-[19rem]">
                <header class="app-topbar">
                    <button @click="sidebarOpen = true" class="rounded-lg p-2 text-zinc-500 hover:bg-zinc-100 lg:hidden">
                        <x-icon name="bars" class="h-5 w-5" />
                    </button>
                    <div class="min-w-0 flex-1">
                        @isset($header){{ $header }}@else<span class="text-base font-medium text-zinc-400">{{ config('app.name') }}</span>@endisset
                    </div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2.5 rounded-xl border border-zinc-200 bg-white py-1.5 pl-1.5 pr-3 text-base shadow-xs hover:border-zinc-300">
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand-600 text-xs font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                <span class="hidden max-w-[120px] truncate font-medium text-zinc-700 sm:block">{{ Auth::user()->name }}</span>
                                <x-icon name="chevron-down" class="hidden h-4 w-4 text-zinc-400 sm:block" />
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">@csrf<x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log out</x-dropdown-link></form>
                        </x-slot>
                    </x-dropdown>
                </header>
                <main class="flex-1 p-4 sm:p-6 lg:p-8">{{ $slot }}</main>
            </div>
        </div>
    </body>
</html>
