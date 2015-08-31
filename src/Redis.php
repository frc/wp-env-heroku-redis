<?php

namespace Frc\WP\Env\Heroku\Redis;

$env = getenv('REDIS_URL') ? getenv('REDIS_URL') : getenv('REDISCLOUD_URL');
if ( $env ) {
    $url = parse_url($env);
    define('WP_REDIS_HOST', trim( $url['host'] ));
    define('WP_REDIS_PORT', trim( $url['port'] ));
    define('WP_REDIS_PASSWORD', trim( $url['pass'] ));
}
