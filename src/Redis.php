<?php

namespace Frc\WP\Env\Heroku\Redis;

$env = getenv('REDIS_URL') ? getenv('REDIS_URL') : getenv('REDISCLOUD_URL');
if ( $env ) {
    $url = parse_url($env);
    define('WP_REDIS_HOST', trim( $url['host'] ));
    define('WP_REDIS_PORT', trim( $url['port'] ));
    define('WP_REDIS_PASSWORD', trim( $url['pass'] ));

    if (getenv('REDIS_SESSION_STORAGE') && getenv('REDIS_SESSION_STORAGE') === 'true') {
        ini_set('session.save_handler','redis');
        ini_set('session.save_path',"tcp://$url[host]:$url[port]?auth=$url[pass]");
    }
    if (getenv('REDIS_GLOBAL_GROUPS')) {
        $groups = array_map('trim', explode(',', getenv('REDIS_GLOBAL_GROUPS')));
        if (!empty($groups)) {
            define('WP_REDIS_GLOBAL_GROUPS', $groups);
        }
    }
}
