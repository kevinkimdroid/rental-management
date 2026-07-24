import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['system-ui', '-apple-system', 'Segoe UI', 'Roboto', 'sans-serif'],
            },
            colors: {
                brand: {
                    50: '#eef5fb',
                    100: '#d6e8f5',
                    200: '#aed1eb',
                    300: '#7ab3dc',
                    400: '#4894cb',
                    500: '#2678b3',
                    600: '#1a68a5',
                    700: '#155480',
                    800: '#13456a',
                    900: '#123a59',
                    950: '#0c253b',
                },
            },
            boxShadow: {
                xs: '0 1px 2px rgba(0,0,0,0.04)',
                sm: '0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04)',
                md: '0 4px 12px -2px rgba(0,0,0,0.08), 0 2px 4px -2px rgba(0,0,0,0.04)',
                lg: '0 12px 40px -8px rgba(0,0,0,0.12), 0 4px 12px -4px rgba(0,0,0,0.06)',
                xl: '0 24px 64px -16px rgba(0,0,0,0.14)',
                inner: 'inset 0 1px 2px rgba(0,0,0,0.04)',
            },
            borderRadius: {
                '2xl': '1rem',
                '3xl': '1.25rem',
            },
            backgroundImage: {
                'mesh': 'radial-gradient(at 27% 37%, rgba(26,104,165,0.1) 0, transparent 50%), radial-gradient(at 97% 21%, rgba(26,104,165,0.06) 0, transparent 50%), radial-gradient(at 52% 99%, rgba(26,104,165,0.05) 0, transparent 50%)',
                'auth': 'linear-gradient(145deg, #000000 0%, #0c253b 45%, #1a68a5 100%)',
                'hero': 'linear-gradient(180deg, #ffffff 0%, #f8fafc 40%, #eef5fb 100%)',
            },
        },
    },

    plugins: [forms],
};
