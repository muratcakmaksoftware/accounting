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
                'resources/js/select2.js', 'resources/js/datatables.js',

                /**
                 * Custom CSS
                 */
                'resources/css/main.css', 'resources/css/fonts.css',

                /**
                 * Custom JS
                 */
                'resources/js/main.js', 'resources/js/inputmask.js'
            ],
            refresh: true,
        }),
    ],
});
