<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('certificate_number', 100)->unique();
            $table->date('issued_date');
            $table->date('expiry_date');
            $table->string('issuing_authority');
            $table->string('stcw_regulation')->nullable();
            $table->string('competency')->nullable();
            $table->string('grade', 50)->nullable();
            $table->enum('status', ['valid', 'expired', 'revoked', 'suspended'])->default('valid');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
};