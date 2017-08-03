<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompositePrimaryKeyToBuyerPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_purchase', function (Blueprint $table) {
            $table->unsignedInteger('buyer_id');
            $table->unsignedInteger('purchase_id');

            $table->primary(['buyer_id', 'purchase_id']);

            $table->foreign('buyer_id')
                ->references('id')->on('buyers')
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
        Schema::table('buyer_purchase', function (Blueprint $table) {
            $table->dropForeign('buyer_purchase_buyer_id_foreign');
            $table->dropForeign('buyer_purchase_purchase_id_foreign');

            $table->dropPrimary(['buyer_id', 'purchase_id']);

            $table->dropColumn('purchase_id');
            $table->dropColumn('buyer_id');
        });
    }
}
