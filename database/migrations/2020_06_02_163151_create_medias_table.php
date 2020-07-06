<?php

use App\Constants\DBTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateMediasTable
 */
class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            DBTable::CORE_MEDIAS,
            function (Blueprint $table) {
                $table->id();
                $table->string('file_name');
                $table->bigInteger('user_id');
                $table->jsonb('metadata')->nullable();
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on(DBTable::AUTH_USERS)->onDelete('cascade');
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
        Schema::dropIfExists(DBTable::CORE_MEDIAS);
    }
}
