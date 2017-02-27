<?php
return array(
    // set your paypal credential
    'client_id' => 'AS-bh2ChLD34DwLCuqWw1BD3iqYzxQKBxg0P_VFOckG8UceXUk9S5fzkNVrOg7NtuyecosYzO_kaCLBh',
    'secret' => 'EC1_97DmFMeJ6Ma8HMdB2PeJLPKdbDFOwEwjeIJ_xvUeBupjlYNpz7aB36YSDPSjelAgadB5-G7bP9hc',
    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);
