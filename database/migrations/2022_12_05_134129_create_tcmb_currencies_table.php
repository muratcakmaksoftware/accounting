<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcmb_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index()->fulltext();
            $table->string('code')->index()->fulltext();
            $table->unsignedInteger('unit')->default(0);
            $table->decimal('forex_buy', 13, 2)->default(0);
            $table->decimal('forex_sell', 13, 2)->default(0);
            $table->decimal('banknote_buy', 13, 2)->default(0);
            $table->decimal('banknote_sell', 13, 2)->default(0);
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
        Schema::dropIfExists('tcmb_currencies');
    }
};
