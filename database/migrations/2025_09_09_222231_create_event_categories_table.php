<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_xxxxxx_create_events_table.php
public function up()
{
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('event_categories');
        $table->string('title');
        $table->text('description');
        $table->dateTime('event_date');
        $table->string('location');
        $table->integer('total_seats');
        $table->integer('available_seats');
        $table->string('image')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_categories');
    }
};
