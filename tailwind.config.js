const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                'principal-main': '#F9592E',
                'principal-wash': '#fbab95',
                'blanc': '#fafafa',
                'noir': {
                    100: '#eeeeee',
                    200: '#e2e2e2',
                    300: '#d0d0d0',
                    400: '#ababab',
                    500: '#8a8a8a',
                    600: '#636363',
                    700: '#505050',
                    800: '#323232',
                    900: '#121212',

                },
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
