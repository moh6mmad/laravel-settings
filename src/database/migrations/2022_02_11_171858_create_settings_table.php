<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name');
            $table->string('setting_group')->default('general');
            $table->longText('value');
            $table->string('input_type')->default('text');
            $table->longText('options')->nullable();
            $table->boolean('hidden')->default(0);
            $table->primary(['name', 'setting_group']);
            $table->timestamps();
        });

        DB::update("ALTER TABLE `settings` ADD INDEX (`id`);");
        DB::update("ALTER TABLE `settings` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
