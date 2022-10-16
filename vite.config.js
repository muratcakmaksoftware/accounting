import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                /**
                 * Packages
                 */
                'resources/css/app.css', 'resources/js/app.js',
                'resources/css/select2.css', 'resources/js/select2.js',

                /**
                 * CSS
                 */
                'resources/css/main.css', 'resources/css/fonts.css',

                /**
                 * JS
                 */
                'resources/js/main.js', 'resources/js/datatables.js', 'resources/js/inputmask.js'
            ],
            refresh: true,
        }),
    ],
});
