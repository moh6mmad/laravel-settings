<?php

use Moh6mmad\LaravelSettings\Controllers\LaravelSettingsController;
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
        return LaravelSettingsController::setting($key, $value);
    }
}