<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_event_registrations_table.php
public function up()
{
    Schema::create('event_registrations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('event_id')->constrained('events');
        $table->foreignId('student_id')->constrained('users');
        $table->timestamp('registered_at');
        $table->string('status')->default('confirmed');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
