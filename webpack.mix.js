const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       tailwindcss('./tailwind.config.js'),
   ]);

mix.browserSync({
    proxy: 'localhost:8000',
    open: false,
    notify: false,
    files: [
        'app/**/*.php',
        'resources/views/**/*.blade.php',
        'resources/js/**/*.js',
        'resources/css/**/*.css',
        'public/js/**/*.js',
        'public/css/**/*.css'
    ],
});
