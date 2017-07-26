<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParticipantIdAndPurchaseIdToParticipantPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participant_purchase', function (Blueprint $table) {
            $table->unsignedInteger('participant_id');
            $table->unsignedInteger('purchase_id');

            $table->foreign('participant_id')
                ->references('id')->on('participants')
                ->onDelete('cascade');
            $table->foreign('purchase_id')
                ->references('id')->on('purchases')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participant_purchase', function (Blueprint $table) {
            $table->dropColumn('participant_id');
            $table->dropColumn('purchase_id');
        });
    }
}
