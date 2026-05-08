<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code', 50)->unique();
            $table->string('title');
            $table->enum('standard_type', ['STCW', 'IMO', 'Internal']);
            $table->string('imo_course_number', 50)->nullable();
            $table->string('category', 100);
            $table->enum('level', ['Basic', 'Operational', 'Management', 'Rating']);
            $table->integer('duration_hours');
            $table->integer('duration_days');
            $table->text('description');
            $table->text('objectives')->nullable();
            $table->text('prerequisites')->nullable();
            $table->foreignId('instructor_id')->nullable()->constrained('instructors')->nullOnDelete();
            $table->integer('max_participants')->default(20);
            $table->integer('passing_score')->default(70);
            $table->enum('status', ['active', 'inactive', 'draft'])->default('active');
            $table->decimal('fee', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};