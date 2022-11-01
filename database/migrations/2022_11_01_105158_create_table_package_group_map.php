<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePackageGroupMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_group_map', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->integer('package_group_id');
            $table->timestamps();

            $table->unique(['package_id', 'package_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_group_map');
    }
}
