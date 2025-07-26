import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',
    'resources/css/main.css',
    'resources/css/home.css',
    'resources/css/about.css',
    'resources/css/howitworks.css',
    'resources/css/contact.css',
    //'resources/css/login.css',
    'resources/js/app.js'
],
            refresh: true,
            
        }),
        tailwindcss(),
    ],
    //i added this to fix the issue with hot reloading in Windows
    server: {
        watch: {
            usePolling: true,
            interval: 100
        }
    }
    //till here
});

// This is a Vite configuration file for a Laravel project.
// It uses the laravel-vite-plugin to handle asset compilation and hot reloading.
// The Tailwind CSS plugin is also included for styling.
// The configuration specifies the input files for CSS and JavaScript, enabling automatic refresh on changes.
