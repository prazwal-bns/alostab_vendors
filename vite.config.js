import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    server: {
        // Bind only to localhost so the dev server is not exposed to the
        // local network or external hosts (mitigates the esbuild CORS issue).
        host: 'localhost',

        // Restrict which files Vite is allowed to serve.  Explicitly deny
        // environment files and other sensitive project paths.
        fs: {
            strict: true,
            deny: ['.env', '.env.*', '*.{crt,pem,key}', 'composer.json', 'composer.lock'],
        },

        // Restrict cross-origin requests to same-origin only during
        // development.  Set to a specific origin string if you run the
        // front-end and back-end on different ports/hosts.
        cors: {
            origin: false,
        },
    },
});
