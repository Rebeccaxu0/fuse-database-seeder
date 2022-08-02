const mix = require('laravel-mix');
require('dotenv').config();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        // require('tw-elements'),
    ]);

if (mix.inProduction()) {
    mix.version();
}
mix.browserSync({
  proxy: process.env.APP_URL,
  files: ["public/css/*.css", "public/js/*.js", "resources/views/**/*"]
});
