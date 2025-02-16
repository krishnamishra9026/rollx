importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");

firebase.initializeApp({
    apiKey: "AIzaSyDMJ7pd6RXpSL2Tw8R0OwWw_FLz6QGJYbk",
    projectId: "shl-testing-472a5",
    messagingSenderId: "844991372542",
    appId: "1:844991372542:web:6cb00c30988fc05feb19af",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function ({
    data: { title, body, icon },
}) {
    return self.registration.showNotification(title, { body, icon });
});
