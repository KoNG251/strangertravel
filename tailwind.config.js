import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {

        },
    },

    plugins: [
        forms, // Load @tailwindcss/forms first
        require('flowbite/plugin')
    ],
};
