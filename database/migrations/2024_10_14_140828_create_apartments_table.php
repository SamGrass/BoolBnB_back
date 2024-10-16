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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->unsignedInteger('room');
            $table->unsignedInteger('beds');
            $table->unsignedInteger('bathroom');
            $table->smallInteger('mq');
            $table->string('city');
            $table->string('address');
            $table->unsignedInteger('civic_number');
            $table->decimal('longitude', 9, 6);
            $table->decimal('latitude', 9, 6);
            $table->string('img');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            // foreign user
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIfExists('apartments');
        });
    }
};
