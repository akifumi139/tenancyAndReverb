import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

Echo.private("test-channel").listen("TestEvent", function (e) {
    const newMessage = document.createElement("li");
    newMessage.textContent = e.message;
    const ul = document.getElementById("messages");
    ul.appendChild(newMessage);
});

document.getElementById("send").addEventListener("click", function () {
    const message = document.getElementById("message").value;
    if (!message) return;
    axios.post("/", { message: message }).then(() => {
        document.getElementById("message").value = "";
    });
});