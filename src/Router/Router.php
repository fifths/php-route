<?php

namespace Router;

class Router
{
    public static $routes = [];
    public static $methods = [];
    public static $callbacks = [];
    public static $error_callback;

    public static function __callstatic($name, $arguments)
    {
        //请求地址
        $uri = $arguments[0];
        //路由
        array_push(self::$routes, $uri);
        //请求类型|方法
        array_push(self::$methods, strtoupper($name));
        //准备执行的方法
        array_push(self::$callbacks, $arguments[1]);
    }

    public static function dispatch()
    {
        try {
            //uri
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            //请求类型
            $method = $_SERVER['REQUEST_METHOD'];
            if (in_array($uri, self::$routes)) {
                $route_pos = array_keys(self::$routes, $uri);
                foreach ($route_pos as $route) {
                    if (self::$methods[$route] == $method || self::$methods[$route] == 'ANY') {
                        if (is_object(self::$callbacks[$route])) {
                            // do function
                            return call_user_func(self::$callbacks[$route]);
                        } else {
                            $segments = explode('@', self::$callbacks[$route]);
                            // new ob
                            $controller = new $segments[0]();
                            return $controller->{$segments[1]}();
                        }
                    }
                }
            }else{
                //regex with routes

            }
            if (self::$error_callback) {
                self::get($_SERVER['REQUEST_URI'], self::$error_callback);
                return self::dispatch();
            } else {
                self::error_404();
                return;
            }
        } catch (\Exception $e) {
            print_r($e->getMessage());
        } catch (\Error $e) {
            print_r($e->getMessage());
        }
    }

    public static function error_404()
    {
        if (stripos(php_sapi_name(), 'cgi') === 0) {
            header('Status: 404 Not Found', true);
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        }
        echo '404';
    }


    public static function error($callback)
    {
        self::$error_callback = $callback;
    }
}