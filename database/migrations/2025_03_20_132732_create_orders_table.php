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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('xendit_reference_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreignId('parent_id')->nullable()->constrained('orders')->onDelete('cascade');
            $table->foreignId('merchant_id')->nullable()->constrained('umkms')->onDelete('cascade');
            $table->decimal('total', 16, 2)->default(0);
            $table->decimal('shipping_cost', 16, 2)->default(0);
            $table->string('payment_method');
            $table->string('address');
            $table->enum('status', ['payment', 'process', 'deliver', 'delivered'])->default('payment');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
