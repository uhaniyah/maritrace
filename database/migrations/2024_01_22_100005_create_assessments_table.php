<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->enum('assessment_type', ['Written', 'Practical', 'Oral', 'Simulation', 'GMDSS', 'Firefighting', 'Survival', 'Medical', 'BRM']);
            $table->date('assessment_date');
            $table->float('score');
            $table->float('max_score');
            $table->float('passing_score');
            $table->enum('result', ['pass', 'fail']);
            $table->string('assessor_name');
            $table->text('remarks')->nullable();
            $table->integer('attempt_number')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assessments');
    }
};