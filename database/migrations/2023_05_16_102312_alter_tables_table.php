<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->integer('number');
            $table->integer('seats');
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('number', 'seats');
        });
    }
};
