<?php

echo "<script language='javascript' type='module'>
    import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js';
    console.log('script firebase iniciado...')

    const firebaseConfig = {
        apiKey: 'AIzaSyAjo-2T-nR7hJ1NvNtbGdP3c62Tn3lYvo4',
        authDomain: 'social-compass-server.firebaseapp.com',
        projectId: 'social-compass-server',
        storageBucket: 'social-compass-server.appspot.com',
        messagingSenderId: '953915826162',
        appId: '1:953915826162:web:7cc721680df45f11ac556b'
    };

    const app = initializeApp(firebaseConfig);
</script>";

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

$app = require __DIR__.'/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$app->run();
