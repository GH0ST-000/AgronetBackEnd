<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_types')->after('password');
            $table->string('last_name')->after('name');
            $table->string('country')->after('user_types');
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_types');
            $table->dropColumn('last_name');
            $table->dropColumn('country');
        });
    }
};
