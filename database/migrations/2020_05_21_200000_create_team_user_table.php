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
        Schema::table(
            DBTables::AUTH_USERS,
            function (Blueprint $table) {
                $table->foreignId('current_team_id')->nullable()->after('username')->constrained(DBTables::AUTH_TEAMS);
            }
        );

        Schema::create(
            DBTables::AUTH_TEAMS_USERS,
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('team_id')->constrained(DBTables::AUTH_TEAMS);
                $table->foreignId('user_id')->constrained(DBTables::AUTH_USERS);
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
        Schema::table(
            DBTables::AUTH_USERS,
            function (Blueprint $table) {
                $table->dropColumn('current_team_id');
            }
        );

        Schema::drop(DBTables::AUTH_TEAMS_USERS);
    }
}
