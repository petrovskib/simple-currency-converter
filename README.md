# Simple Currency Converter Api Platform
## Architecture
- Backend is Laravel 11 REST API

# How to start project
- run this command:
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
- From this point onward, you can use `./vendor/bin/sail` commands  every time. For example to boot up services,
  you will run `./vendor/bin/sail up`
- Run `php artisan migrate` through sail or docker compose.
