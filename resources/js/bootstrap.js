/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Security hardening for Axios:
 *
 * - baseURL: restrict requests to the same origin to prevent SSRF attacks
 *   where user-controlled input could route requests to internal services.
 * - maxRedirects: cap redirects to limit redirect-chain attacks and prevent
 *   credential leakage to unexpected hosts (follow-redirects CVEs).
 * - maxBodyLength / maxContentLength: cap request/response body sizes to
 *   protect against DoS via oversized payloads (axios DoS CVE).
 * - withXSRFToken: ensure the XSRF token is attached to same-origin requests.
 */
window.axios.defaults.baseURL = window.location.origin;
window.axios.defaults.withCredentials = true;
window.axios.defaults.withXSRFToken = true;
window.axios.defaults.maxRedirects = 5;
window.axios.defaults.maxBodyLength = 10 * 1024 * 1024;   // 10 MB
window.axios.defaults.maxContentLength = 10 * 1024 * 1024; // 10 MB

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
