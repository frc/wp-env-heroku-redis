# wp-env-heroku-redis

Expose Heroku redis addon configuration to WordPress.

Accepted env keys:

- REDIS_URL: If you are using heroku-redis addon
- REDISCLOUD_URL: If you are using rediscloud addon
- REDIS_SESSION_STORAGE: Set to "true" (without quotes) if you want PHP sessions to be persisted in Redis storage, instead of PHP's default of using machine's temporary directory. This is useful when you need to persist sessions across multiple dynos.

## Incompatible changes from 1.0.0

In v2.0.0, `REDIS_SESSION_STORAGE` explicitly needs to be set to the string "true" instead of a truthy value.
