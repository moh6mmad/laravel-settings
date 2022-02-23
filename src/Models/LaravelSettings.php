<?php

namespace Moh6mmad\LaravelSettings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaravelSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'value',
        'input_type',
        'options',
        'setting_group'
    ];

    public $table = 'settings';

    /**
     * Insert into setting table, if exists ignore it
     * 
     * @param array $values
     */
    public static function createOrIgnore(array $values)
    {
        try {
            
            LaravelSettings::create($values);

        } catch (\Throwable $th) {
            
            return $th->getMessage();
        }
    }
}
