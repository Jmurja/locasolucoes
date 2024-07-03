import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/reserves.js',
                'resources/js/validate.js',
                'resources/js/rental-items.js',
                'resources/js/fullcalendar.js',
                'resources/css/fullcalendar.css',
            ],
            refresh: true,
        }),
    ],
});
