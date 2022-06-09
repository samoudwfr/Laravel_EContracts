<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reference');
            $table->string('document');
            
            $table->foreignId('sender_id')
                ->constrained('civils')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('receiver_id')
                ->constrained('civils')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('lawyer_id')
                ->constrained('civils')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('statusLawyer_id')
                ->constrained('statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('statusReceiver_id')
            ->constrained('statuses')
            ->onUpdate('cascade')
            ->onDelete('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
