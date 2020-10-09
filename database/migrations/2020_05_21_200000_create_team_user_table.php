<?php

use App\Constants\DBTables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTeamUserTable
 */
class CreateTeamUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            DBTables::AUTH_TEAMS_USERS,
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('team_id');
                $table->foreignId('user_id');
                $table->string('role')->nullable();
                $table->timestamps();

                $table->unique(['team_id', 'user_id']);
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
        Schema::drop(DBTables::AUTH_TEAMS_USERS);
    }
}
