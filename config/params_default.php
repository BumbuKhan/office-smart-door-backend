<?php

return [
    'adminEmail' => 'admin@example.com',
    'cookieValidationKey' => 'super-secret-key',

    // this is the static IP address that ESP8266 is connected to
    // I'll also provide a super secret token for additional secure
    // so final URL will look like: http://STATIC_IP/ENDPOINT?token=095A16f5L0nz467P756y0x0SX06Z6u
    'IOT_DOOR_OPEN_URL' => 'http://STATIC_IP/ENDPOINT?token=TOKEN',
];
