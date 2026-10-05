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
            $table->string('service_image2')->nullable();
            $table->string('service_image3')->nullable();
            $table->string('service_image4')->nullable();

            $table->string('title_text2_ar')->nullable();
            $table->string('title_text2_en')->nullable();
            $table->string('title_text3_ar')->nullable();
            $table->string('title_text3_en')->nullable();
            $table->string('title_text4_ar')->nullable();
            $table->string('title_text4_en')->nullable();

            $table->text('description_text2_ar')->nullable();
            $table->text('description_text2_en')->nullable();
            $table->text('description_text3_ar')->nullable();
            $table->text('description_text3_en')->nullable();
            $table->text('description_text4_ar')->nullable();
            $table->text('description_text4_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'service_image2',
                'service_image3',
                'service_image4',
                'title_text2_ar',
                'title_text2_en',
                'title_text3_ar',
                'title_text3_en',
                'title_text4_ar',
                'title_text4_en',
                'description_text2_ar',
                'description_text2_en',
                'description_text3_ar',
                'description_text3_en',
                'description_text4_ar',
                'description_text4_en',
            ]);
        });
    }
};
