<?php

namespace Moh6mmad\LaravelSettings\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Moh6mmad\LaravelSettings\Models\LaravelSettings as Setting;

class LaravelSettingsController extends Controller
{
    
    public static function get(string $key = '')
    {
       echo self::setting('template.title');
    }

    /**
     * This function allows app to get directly settings from database
     * settings should be called like setting('setting_group.setting_key');
     *
     * @param string $key
     * @param mixed $value
     *
     * @return array|string|void
     */
    public static function setting(string $key = '', $value = '')
    {
        if (empty($key)) {
            return;
        }

        $settingKey = explode('.', $key);

        if (!is_array($settingKey)) {
            return;
        }

        if (empty($value)) {
            $setting = Setting::where('setting_group', $settingKey[0])->where('name', $settingKey[1])->first();

            if (empty($setting)) {
                return false;
            }
        
            $array = json_decode($setting->value, true);
        
            if (is_array($array)) {
                return  $array ?? '';
            }

            return $setting->value;
        } else {
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            }
        
            try {
                Setting::updateOrCreate(
                    [
                    'setting_group' => $settingKey[0],
                    'name'          => $settingKey[1],
                ],
                    [
                    'value' => $value
                ]
                );
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }
}
