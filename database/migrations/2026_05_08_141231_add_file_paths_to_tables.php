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
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('status');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->string('seaman_book_path')->nullable()->after('seaman_book');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn('file_path');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('seaman_book_path');
        });
    }
};
