<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['Theory', 'Practical', 'Simulation', 'Assessment']);
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->float('duration_hours');
            $table->integer('order_number');
            $table->boolean('is_mandatory')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('modules');
    }
};