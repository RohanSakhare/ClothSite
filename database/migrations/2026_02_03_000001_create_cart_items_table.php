<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('variant_id')->nullable()->constrained('product_variants')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable()->index();

            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->string('image')->nullable();
            $table->unsignedInteger('stock')->default(0);

            $table->timestamps();

            $table->index(['product_id', 'variant_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
