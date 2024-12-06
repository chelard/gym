<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('plan_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('price_paid', 10, 2);
            $table->string('status')->default(\App\Enums\SubscriptionStatus::Activa);
            $table->integer('frozen_days')->default(0);
            $table->date('last_access_date')->nullable();
            $table->integer('remaining_days')->nullable();
           // $table->unsignedBigInteger('promotion_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
           // $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscriptions');
    }
};
