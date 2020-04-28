window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios')

axios.defaults.baseURL = '/api'
axios.defaults.headers.common['Accept'] = 'application/json'

const accessToken = localStorage.getItem('accessToken')

if (accessToken) {
    axios.defaults.headers.common['Authorization'] = accessToken
}

axios.interceptors.request.use(request => {
    return request
}, error => {
    return Promise.reject(error.response.data)
})

axios.interceptors.response.use(response => {
    return response.data
}, error => {
    if (error.response) {
        // The request was made and the server responded with a status code
        // that falls out of the range of 2xx
        console.log(error.response.data)
        console.log(error.response.status)
        console.log(error.response.headers)
        console.log(error.config)

        return Promise.reject(error.response.data)
    } else if (error.request) {
        // The request was made but no response was received
        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
        // http.ClientRequest in node.js
        console.log(error.request)
        console.log(error.config)
    } else {
        // Something happened in setting up the request that triggered an Error
        console.log('Error', error.message)
        console.log(error.config)
    }
})

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'
//
// window.io = require('socket.io-client')
//
// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':' + process.env.MIX_SOCKET_PORT,
//     auth: {
//         headers: {
//             Authorization: localStorage.getItem('accessToken') || null
//         }
//     }
// })
