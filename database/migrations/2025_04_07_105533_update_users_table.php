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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 40);
            $table->string('phone_number', 15)->nullable();
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->boolean('is_verifier')->default(false);
            $table->enum('status', ['avtive', 'suspended','waiting_to_approved','acount_removed'])->default('waiting_to_approved');
            $table->string('identity_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
