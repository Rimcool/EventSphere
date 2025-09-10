<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // In the migration file
public function up()
{
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('category');
        $table->text('description');
        $table->date('date');
        $table->time('time');
        $table->string('location');
        $table->integer('total_seats')->default(0);
        $table->datetime('registration_deadline')->nullable();
        $table->string('image_path')->nullable();
        $table->text('tags')->nullable();
        $table->boolean('featured')->default(false);
        $table->boolean('registration_required')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
