<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('name');
            $table->string('theme');
            $table->string('theme_logo');
            $table->string('theme_navbar');
            $table->string('theme_sidebar');
            $table->boolean('toggle_sidebar')->default(false);
        });

         \App\Models\Config::create([
            'logo' => new \Illuminate\Http\UploadedFile(public_path('img/logo.svg'), 'logo.svg'),
            'name' => 'Laravel app',
            'theme' => 'bg1',
            'theme_logo' => 'blue',
            'theme_navbar' => 'blue',
            'theme_sidebar' => 'bg1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
