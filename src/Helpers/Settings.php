<?php

use Moh6mmad\LaravelSettings\Models\LaravelSettings;
if (!function_exists('setting')) {
/**
 * This function allows app to get directly settings from database
 * settings should be called like setting('setting_group.setting_key');
 *
 * @param string $key
 * @param mixed $value
 *
 * @return array|string|void
 */
    function setting(string $key = '', $value = '')
    {
        LaravelSettings::setting($key, $value);
    }
}