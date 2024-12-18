<?php

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suscription_id')->constrained();
            $table->string('payment_date');
            $table->decimal('amount', 8, 2);
            $table->string('payment_method')->default(PaymentMethod::Efectivo);
            $table->string('reference_transaction')->nullable();
            $table->string('status')->default(PaymentStatus::Pendiente);
            $table->integer('installment_number')->default(1);
            $table->integer('total_installments')->default(1);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
