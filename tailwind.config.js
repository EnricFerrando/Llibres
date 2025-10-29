import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '4rem',
                xl: '5rem',
            },
        },
        extend: {
            colors: {
                primary: {
                    50: '#f5fbff',
                    100: '#e6f3ff',
                    200: '#bfe0ff',
                    300: '#99ccff',
                    400: '#66a8ff',
                    500: '#3384ff',
                    600: '#2d72e6',
                    700: '#2359b3',
                    800: '#1a3f80',
                    900: '#0f274d',
                },
                muted: '#6b7280',
                accent: '#ff6b6b',
                glass: 'rgba(255,255,255,0.6)'
            },
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'soft-lg': '0 10px 30px rgba(16,24,40,0.08)',
            },
            borderRadius: {
                'xl': '1rem',
            }
        },
    },

    plugins: [forms],
};
