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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'main_text_ar')) {
                $table->text('main_text_ar')->nullable();
            }
            if (!Schema::hasColumn('services', 'main_text_en')) {
                $table->text('main_text_en')->nullable();
            }
            if (!Schema::hasColumn('services', 'title_text_ar')) {
                $table->string('title_text_ar')->nullable();
            }
            if (!Schema::hasColumn('services', 'title_text_en')) {
                $table->string('title_text_en')->nullable();
            }
            if (!Schema::hasColumn('services', 'description_text_ar')) {
                $table->text('description_text_ar')->nullable();
            }
            if (!Schema::hasColumn('services', 'description_text_en')) {
                $table->text('description_text_en')->nullable();
            }
            if (!Schema::hasColumn('services', 'button_text1_ar')) {
                $table->string('button_text1_ar')->nullable();
            }
            if (!Schema::hasColumn('services', 'button_text1_en')) {
                $table->string('button_text1_en')->nullable();
            }
            if (!Schema::hasColumn('services', 'button_text2_ar')) {
                $table->string('button_text2_ar')->nullable();
            }
            if (!Schema::hasColumn('services', 'button_text2_en')) {
                $table->string('button_text2_en')->nullable();
            }
        });

        Schema::table('why_us', function (Blueprint $table) {
            if (!Schema::hasColumn('why_us', 'main_text_ar')) {
                $table->text('main_text_ar')->nullable();
            }
            if (!Schema::hasColumn('why_us', 'main_text_en')) {
                $table->text('main_text_en')->nullable();
            }
            if (!Schema::hasColumn('why_us', 'sub_text1_ar')) {
                $table->text('sub_text1_ar')->nullable();
            }
            if (!Schema::hasColumn('why_us', 'sub_text1_en')) {
                $table->text('sub_text1_en')->nullable();
            }
            if (!Schema::hasColumn('why_us', 'sub_text2_ar')) {
                $table->text('sub_text2_ar')->nullable();
            }
            if (!Schema::hasColumn('why_us', 'sub_text2_en')) {
                $table->text('sub_text2_en')->nullable();
            }
        });

        Schema::table('who_us', function (Blueprint $table) {
            if (!Schema::hasColumn('who_us', 'main_text_ar')) {
                $table->text('main_text_ar')->nullable();
            }
            if (!Schema::hasColumn('who_us', 'main_text_en')) {
                $table->text('main_text_en')->nullable();
            }
            if (!Schema::hasColumn('who_us', 'sub_text1_ar')) {
                $table->text('sub_text1_ar')->nullable();
            }
            if (!Schema::hasColumn('who_us', 'sub_text1_en')) {
                $table->text('sub_text1_en')->nullable();
            }
            if (!Schema::hasColumn('who_us', 'sub_text2_ar')) {
                $table->text('sub_text2_ar')->nullable();
            }
            if (!Schema::hasColumn('who_us', 'sub_text2_en')) {
                $table->text('sub_text2_en')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'main_text_ar',
                'main_text_en',
                'title_text_ar',
                'title_text_en',
                'description_text_ar',
                'description_text_en',
                'button_text1_ar',
                'button_text1_en',
                'button_text2_ar',
                'button_text2_en'
            ]);
        });

        Schema::table('why_us', function (Blueprint $table) {
            $table->dropColumn([
                'main_text_ar',
                'main_text_en',
                'sub_text1_ar',
                'sub_text1_en',
                'sub_text2_ar',
                'sub_text2_en'
            ]);
        });

        Schema::table('who_us', function (Blueprint $table) {
            $table->dropColumn([
                'main_text_ar',
                'main_text_en',
                'sub_text1_ar',
                'sub_text1_en',
                'sub_text2_ar',
                'sub_text2_en'
            ]);
        });
    }
};
