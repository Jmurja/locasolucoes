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
                'resources/js/delete-user.js',
                'resources/js/fullcalendar.js',
                'resources/js/rental-items.js',
                'resources/js/reserves.js',
                'resources/js/reserves-request.js',
                'resources/js/user.js',
            ],
            refresh: true,
        }),
    ],
});
