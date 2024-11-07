// import { checkAuth } from '$lib/auth.js';
// import { goto } from '$app/navigation';


// // @ts-ignore
// export async function handle({ event, resolve }) {

//     const isAuthenticated = checkAuth();

//     if (event.url.pathname.startsWith('/dashboard') && !isAuthenticated) {

//         return goto('/login');

//     }

//     return await resolve(event);

// }