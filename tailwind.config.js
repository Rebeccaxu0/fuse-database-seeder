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
                'fuse-background':     '#ebebeb',
                'fuse-blue':           '#83c9e3',
                'fuse-border-green':   '#507F3A',
                'fuse-border-grey':    '#d7d7d7',
                'fuse-button-green':   '#2fc049',
                'fuse-download-green': '#20bb42',
                'fuse-gray-100':       '#fafafa',
                'fuse-gray-500':       '#cedfe6',
                'fuse-gray-700':       '#909ca8',
                'fuse-gray-900':       '#545b49',
                'fuse-green-100':      '#dff4d3',
                'fuse-green-500':      '#b6dd9f',
                'fuse-green':          '#6cb306',
                'fuse-green-900':      '#497c00',
                'fuse-link-violet':    '#6666ff',
                'fuse-lt-blue':        '#81edf8',
                'fuse-ml-grey':        '#bfc8cc',
                'fuse-nav-blue':       '#339fc7',
                'fuse-nav-green':      '#136b23',
                'fuse-orange':         '#e46634',
                'fuse-orange-100':     '#f8e3d9',
                'fuse-orange-500':     '#f4a876',
                'fuse-pink-100':       '#f2e2e8',
                'fuse-pink':           '#e22659',
                'fuse-pink-500':       '#e8a6bb',
                'fuse-purple':         '#6e59ac',
                'fuse-red':            '#c10000',
                'fuse-shade-purple':   '#999999',
                'fuse-teal':           '#297f9e',
                'fuse-teal-100':       '#d3e9ef',
                'fuse-teal-500':       '#60b5cc',
                'fuse-teal-dk':        '#086384',
                'fuse-teal-dk-100':    '#e4edef',
                'fuse-teal-dk-200':    '#c7dce1',
                'fuse-teal-dk-300':    '#aacad2',
                'fuse-teal-dk-500':    '#6fa6b5',
                'fuse-yellow':         '#f7e70b'
            },
            spacing: {
                '72': '18rem'
            },
            container: {
                padding: {
                    DEFAULT: '1rem',
                    sm:      '2rem',
                    lg:      '3rem',
                    xl:      '3rem',
                    '2xl':   '6rem'
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
