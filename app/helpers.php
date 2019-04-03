<?php

use Yaf\Registry as YafRegistry;

if (!function_exists('config')) {
    /**
     * @param string $property
     * @param mixed  $default
     *
     * @return mixed
     */
    function config($property, $default = null)
    {
        $configArr = YafRegistry::get('config');

        return $configArr[$property] ?? $default;
    }
}

if (!function_exists('is_dev')) {
    /**
     * @return boolean
     */
    function is_dev()
    {
        return environment() == 'develop' ? true : false;
    }
}

if (!function_exists('environment')) {
    /**
     * 获取当前运行环境名称：develop/product.
     *
     * @return string
     */
    function environment()
    {
        return getenv('APP_ENV') ?: (defined('APP_ENV') ? APP_ENV : 'develop');
    }
}
