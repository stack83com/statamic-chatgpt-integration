let mix = require('laravel-mix');

mix.js('resources/js/fieldtype.js', 'dist/js/openai.js').vue({version: 2});
