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
        Schema::table('heroes', function (Blueprint $table) {
            if (!Schema::hasColumn('heroes', 'title_ar')) {
                $table->text('title_ar')->nullable();
            }
            if (!Schema::hasColumn('heroes', 'title_en')) {
                $table->text('title_en')->nullable();
            }
            if (!Schema::hasColumn('heroes', 'content_ar')) {
                $table->text('content_ar')->nullable();
            }
            if (!Schema::hasColumn('heroes', 'content_en')) {
                $table->text('content_en')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'title_en', 'content_ar', 'content_en']);
        });
    }
};
