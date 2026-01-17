const mix = require("laravel-mix");
const path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

mix.js("resources/js/app.js", "public/js")
    .vue()
    .postCss("resources/css/tailwind.css", "public/css", [
        require("tailwindcss"),
        require("autoprefixer"),
    ])
    .version();
