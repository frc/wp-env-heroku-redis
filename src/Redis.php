<?php

namespace Frc\WP\Env\Heroku\Redis;

if (getenv('REDIS_TLS_URL')){
    $env = getenv('REDIS_TLS_URL');
} else if (getenv('REDIS_URL')){
    $env = getenv('REDIS_URL');
} else {
    $env = getenv('REDISCLOUD_URL');
}
if ( $env ) {
    $url = parse_url($env);
    $scheme = 'tcp';
    define('WP_REDIS_HOST', trim( $url['host'] ));
    define('WP_REDIS_PORT', trim( $url['port'] ));
    define('WP_REDIS_PASSWORD', trim( $url['pass'] ));

    if ($url['scheme'] == 'rediss') {
        $scheme = 'tls';
        define('WP_REDIS_SCHEME', $scheme);
        define('WP_REDIS_SSL_CONTEXT', ['verify_peer' => false, 'verify_peer_name'  => false]);
    }

    if (getenv('REDIS_SESSION_STORAGE') && getenv('REDIS_SESSION_STORAGE') === 'true') {
        ini_set('session.save_handler','redis');
        ini_set('session.save_path',"$scheme://$url[host]:$url[port]?auth[user]=$url[user]&auth[pass]=$url[pass]");
    }
}