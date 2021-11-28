//const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './config/*.php',
    ],

    darkMode: false,
    theme: {
        fontFamily: {
            'display': ['Montserrat', 'Calibri', 'Arial', 'sans-serif'],
            'sans': ['Inter', 'Helvetica', 'Arial', 'sans-serif']
        },
        extend: {
            colors: {
                'fuse-dk-teal': '#086384',
                'fuse-dk-teal-500': '#6fa6b5',
                'fuse-dk-teal-100': '#e4edef',
                'fuse-teal': '#297f9e',
                'fuse-teal-500': '#60b5cc',
                'fuse-teal-100': '#d3e9ef',
                'fuse-orange': '#e46634',
                'fuse-orange-500': '#f4a876',
                'fuse-orange-100': '#f8e3d9',
                'fuse-gray-100': '#fafafa',
                'fuse-pink': '#e22659',
                'fuse-pink-500': '#e8a6bb',
                'fuse-pink-100':'#f2e2e8',
                'fuse-green': '#6cb306',
                'fuse-green-500': '#b6dd9f',
                'fuse-green-100': '#dff4d3'

            },
            spacing: {
                '72': '18rem'
            },
            container: {
                padding: {
                    DEFAULT: '1rem',
                    sm: '2rem',
                    lg: '3rem',
                    xl: '3rem',
                    '2xl': '6rem'
                },
                center: true,
            }
        }
    },
    variants: {},
    plugins: [
        require('tailwindcss'),
        require('autoprefixer'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ]
}
