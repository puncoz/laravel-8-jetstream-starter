<?php

use App\Constants\DBTables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTeamsTable
 */
class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            DBTables::AUTH_TEAMS,
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->index()->constrained(DBTables::AUTH_USERS);
                $table->string('name');
                $table->boolean('personal_team');
                commonMigration($table, true, true);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTables::AUTH_TEAMS);
    }
}
