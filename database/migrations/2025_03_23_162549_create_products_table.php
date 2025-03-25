<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('historical_context');
            $table->decimal('starting_price', 10, 2);
            $table->timestamp('auction_end_date');
            $table->enum('status', ['active', 'sold', 'expired'])->default('active');
            $table->foreignId('category_id')->constrained('categories'); // category reference without cascade
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // seller reference
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
