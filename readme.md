# php-route


## nginx
```
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
```

```php
    use \Router\Router;
    Router::get('/', function () {
        echo 'Hello world!';
    });
    Router::dispatch();
```