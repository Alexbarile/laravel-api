<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // creiamo COLONNA
            $table->unsignedBigInteger('type_id')
                ->nullable()
                ->after('id');

            // creiamo FOREIGN KEY
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // 1 passaggio
            $table->dropForeign('posts_type_id_foreign');

            // 2 passaggio
            $table->dropColumn('type_id');
        });
    }
};

?>