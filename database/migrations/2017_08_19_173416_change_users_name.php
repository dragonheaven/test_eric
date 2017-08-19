<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Remove name field, add first_name, last_name
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
        });

        // If some users are already registered, split their name
        DB::statement('update users set first_name = SUBSTRING_INDEX(`name`, " ", 1)');
        DB::statement('update users set last_name = SUBSTRING(`name`, LOCATE(" ", `name`) + 1)');

        // Let's drop old field
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove first_name, last_name field, add name field
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
        });

        // Convert names
        DB::statement('update users set name = CONCAT(`first_name`, " ", `last_name`)');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
        });
    }
}
