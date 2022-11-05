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
        Schema::create('payables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('currency_type_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('payment_method_type_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('price', '13', '2');
            $table->date('expires_at');
            $table->string('description', 2500)->nullable(true);
            $table->softDeletes();
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
        Schema::dropIfExists('payables');
    }
};
