<?php

/**
 * Description of Dee
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Dee
{
    /**
     * @var \dee\base\Application
     */
    public static $app;
    public static $classMap;
    public static $aliases = ['@dee' => __DIR__];

    public static function setAlias($alias, $path)
    {
        if (strncmp($alias, '@', 1)) {
            $alias = '@' . $alias;
        }
        $alias = rtrim($alias, '/');
        if ($path === null) {
            unset(static::$aliases[$alias]);
        } else {
            static::$aliases[$alias] = rtrim($path, '/');
            krsort(static::$aliases);
        }
    }

    public static function getAlias($alias)
    {
        if (strncmp($alias, '@', 1)) {
            return $alias;
        }
        foreach (static::$aliases as $key => $path) {
            if (strpos($alias . '/', $key . '/') === 0) {
                return $path . substr($alias, strlen($key));
            }
        }
        return false;
    }

    public static function autoload($class)
    {
        if (isset(static::$classMap[$class])) {
            require static::$classMap[$class];
            return true;
        } else {
            $file = static::getAlias('@' . str_replace('\\', '/', $class)) . '.php';
            if (is_file($file)) {
                require $file;
                return true;
            }
        }
        return false;
    }

    public static function createObject($type, $params = [])
    {
        if (is_string($type)) {
            $class = $type;
            $type = [];
        } else {
            $class = $type['__class'];
            unset($type['__class']);
        }
        if (count($params)) {
            $reff = new ReflectionClass($class);
            $object = $reff->newInstanceArgs($params);
        } else {
            $object = new $class();
        }
        foreach ($type as $name => $value) {
            $object->$name = $value;
        }
        return $object;
    }

    public static function singkatAngka($n, $p = 1)
    {
        return static::$app->singkatAngka($n, $p);
    }
    public static function curl($url)   {
             $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
    }   
   
    public static function createUrl($route, $params = [])
    {
        // print_r($route);
        // exit();
        return static::$app->createUrl($route, $params);
    }

    public static function redirect($route, $params = [])
    {
        header('Location: ' . static::createUrl($route, $params));
        exit();
    }

    public static function hashData($data, $key)
    {
        $hash = hash_hmac('sha256', $data, $key);
        return $hash;
    }

    public static function validateData($data, $key)
    {
        if (preg_match('/^([a-f0-9]+):(.*)/', $data, $matchs)) {
            if (hash_hmac('sha256', $matchs[2], $key) === $matchs[1]) {
                return $matchs[2];
            }
        }
        return false;
    }
    private static $_keys = [];

    public static function getKey($name, $length = 32)
    {
        if (!isset(self::$_keys[$name])) {
            $keyName = md5($name);
            $filename = static::getAlias("@app/runtime/key-{$keyName}.txt");
            if (is_file($filename)) {
                self::$_keys[$name] = file_get_contents($filename);
            } else {
                self::$_keys[$name] = strtr(substr(base64_encode(openssl_random_pseudo_bytes($length)), 0, $length), '+/=', '_-.');
                file_put_contents($filename, self::$_keys[$name]);
            }
        }
        return self::$_keys[$name];
    }
}

Dee::$classMap = require(__DIR__ . '/classes.php');
spl_autoload_register(['Dee', 'autoload']);
