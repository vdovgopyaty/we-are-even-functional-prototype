<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompositePrimaryKeyToParticipantPurchaseTable extends Migration
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

            $table->primary(['participant_id', 'purchase_id']);

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
            $table->dropForeign('participant_purchase_participant_id_foreign');
            $table->dropForeign('participant_purchase_purchase_id_foreign');

            $table->dropPrimary(['participant_id', 'purchase_id']);

            $table->dropColumn('purchase_id');
            $table->dropColumn('participant_id');
        });
    }
}
