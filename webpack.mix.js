const mix = require('laravel-mix');

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
const Public = 'public/';
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .combine(
        [
            Public + 'front/js/jquery-3.0.0.min.js',
            Public + 'front/js/jquery-migrate-3.0.0.min.js',
            Public + 'front/js/plugins.js',
            Public + 'front/js/lazyload.min.js',
            Public + 'front/js/scripts.js',
        ], Public + 'js/front/front.js')
    .styles(
        [
            Public + 'front/css/plugins/bootstrap.min.css',
            Public + 'front/css/plugins/animate.css',
            Public + 'front/css/plugins/ionicons.min.css',
            Public + 'front/css/plugins/pe-icon-7-stroke.css',
            Public + 'front/css/plugins/fontawesome-all.min.css',
            Public + 'front/css/plugins/justifiedGallery.min.css',
            Public + 'front/css/plugins/YouTubePopUp.css',
            Public + 'front/css/plugins/slick.css',
            Public + 'front/css/plugins/slick-theme.css',
            Public + 'front/css/plugins/swiper.min.css',
            Public + 'front/css/style.css',
        ], Public + 'css/front/front.css')
    .version();
