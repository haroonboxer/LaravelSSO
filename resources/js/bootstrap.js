// import 'bootstrap';

// /**
//  * We'll load the axios HTTP library which allows us to easily issue requests
//  * to our Laravel back-end. This library automatically handles sending the
//  * CSRF token as a header based on the value of the "XSRF" token cookie.
//  */

// import axios from 'axios';
// window.axios = axios;

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// /**
//  * Initialize Laravel Echo.
//  * Since we're using CDN links, `Echo` and `Pusher` are already available globally.
//  */

// window.Echo = new Echo({
//     broadcaster: 'pusher', // or 'reverb' if using Laravel Reverb
//     key: process.env.MIX_PUSHER_APP_KEY, // or process.env.MIX_REVERB_APP_KEY for Reverb
//     wsHost: process.env.MIX_PUSHER_HOST || window.location.hostname, // or process.env.MIX_REVERB_HOST
//     wsPort: process.env.MIX_PUSHER_PORT || 80, // or process.env.MIX_REVERB_PORT
//     wssPort: process.env.MIX_PUSHER_PORT || 443, // or process.env.MIX_REVERB_PORT
//     forceTLS: (process.env.MIX_PUSHER_SCHEME || 'https') === 'https', // or process.env.MIX_REVERB_SCHEME
//     encrypted: true,
//     disableStats: true,
//     enabledTransports: ['ws', 'wss'],
// });


import 'bootstrap';
import axios from 'axios';
import Echo from 'laravel-echo';

/**
 * Configure Axios for making HTTP requests.
 */
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Initialize Laravel Echo with Reverb.
 */
window.Echo = new Echo({
    broadcaster: 'reverb',
    host: process.env.MIX_REVERB_HOST || '127.0.0.1',
    port: process.env.MIX_REVERB_PORT || 6001,
    scheme: process.env.MIX_REVERB_SCHEME || 'http',
    autoConnect: true, // Ensure Echo connects automatically
});

/**
 * Debugging: Check if Echo connects successfully.
 */
window.Echo.connector.socket.on('connect', () => {
    console.log("✅ Connected to Reverb, Socket ID:", window.Echo.socketId());
});

