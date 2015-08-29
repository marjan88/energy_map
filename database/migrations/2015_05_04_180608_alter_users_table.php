<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('users', function (Blueprint $table) {

            $table->string('first_name');
            $table->string('last_name');
            $table->string('street');
            $table->string('phone');
            $table->string('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('users', function($table) {           
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('street');
            $table->dropColumn('phone');
            $table->dropColumn('city');
        });
    }

}
