<?php

namespace Moh6mmad\LaravelSettings\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Moh6mmad\LaravelSettings\Models\LaravelSettings as Setting;

class LaravelSettingsController extends Controller
{
    static public $settings = null;
    static private $settingsLoaded = false;
    
    /**
     * Initial the feature and loading all settings for first call
     * 
     * @param bool|void
     */
    protected static function loadAdd()
    {
        if (self::$settingsLoaded) {
            return [];
        }

        if (empty(self::$settings)) {
            try {
                $settings = DB::table('settings')->get();
                self::$settingsLoaded = true;
            } catch (\Throwable $th) {
                $settings = [];
            }
        }

        if (empty($settings)) {
            return false;
        }

        foreach ($settings as $setting) {
            self::$settings[$setting->setting_group][$setting->name] = $setting->value;
        }
    }

    /**
     * Getting a specific setting value
     * 
     * @param string $key
     * 
     * @return string|array
     */
    public static function get(string $key = '')
    {
        if (empty($key)) {
            return;
        }

        $settingKey = explode('.', $key);

        if (!is_array($settingKey)) {
            return;
        }

        if (empty(self::$settings)) {
            self::loadAdd();
        }
        
        if (empty(self::$settings) || empty(self::$settings[$settingKey[0]])) {
            return false;
        }

        $group = self::$settings[$settingKey[0]];
        
        if (empty( $group[$settingKey[1]])) {
            return false;
        }

        $array = json_decode($group[$settingKey[1]], true);
    
        if (is_array($array)) {
            return  $array ?? '';
        }

        return $group[$settingKey[1]] ?? false;
    }

    /**
     * Set & update a setting value
     * 
     * @param string $key
     * @param string $value
     * 
     * @return bool|void
     */
    public static function set(string $key = '', $value = null)
    {
        if (empty($key) || empty($value)) {
            return;
        }

        $settingKey = explode('.', $key);

        if (!is_array($settingKey)) {
            return;
        }

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

        return empty($value) ? self::get($key) : self::set($key, $value);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Setting::select('setting_group')->where('hidden', '0')->groupBy('setting_group')->get();
        $settings = Setting::where('hidden', '0')->get();
        
        return view('laravel-settings::settings.index', compact('settings', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laravel-settings::settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('name')) {

            Setting::insert([
                'name' => $request->input('name'),
                'value' => $request->input('value'),
                'options' => $request->input('options') ?? '',
                'input_type' => $request->input('input_type') ?? '',
                'setting_group' => $request->input('setting_group'),
            ]);

        } elseif ($request->has('settings')) {

            foreach ($request->input('settings') as $key => $setting) {

                foreach ($setting as $name => $value) {

                    Setting::updateOrCreate(
                        [
                            'name'=>  $name, 
                            'setting_group' =>  $key
                        ],
                        [
                            'value' => $value,  
                            'input_type' => $request->input('types')[$name],  
                            'options' => $request->input('options')[$name] ?? ''
                        ]
                    );

                }                
            }
        }
        
        return redirect()->back()->with('success', 'New setting has been stored in database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function delete($settingId)
    {
        Setting::where('id', $settingId)->delete();
        return redirect()->back()->with('success', 'Selected setting record has been deleted from database.');
    }
}
