import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/fullcalendar.css',
                'resources/css/welcome.css',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/datepicker.js',
                'resources/js/user-delete.js',
                'resources/js/fullcalendar.js',
                'resources/js/rental-items.js',
                'resources/js/reserves.js',
                'resources/js/reserves-request.js',
                'resources/js/user.js',
                'resources/js/welcome.js',
                'resources/js/visitor-fullcalendar.js',
                'resources/js/visitor-mask.js',
                'resources/js/user-mask.js',

            ],
            refresh: true,
        }),
    ],
});
