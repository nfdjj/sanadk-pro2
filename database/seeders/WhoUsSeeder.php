<?php

namespace Database\Seeders;

use App\Models\WhoUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhoUsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if whous data already exists
        if (WhoUs::count() == 0) {
            WhoUs::create([
                'main_text_ar' => 'من نحن',
                'main_text_en' => 'Who We Are',
                'sub_text1_ar' => 'شركة متخصصة في خدمات العمالة والاستقدام',
                'sub_text1_en' => 'A company specialized in labor and recruitment services',
                'sub_text2_ar' => 'نسعى لتحقيق رضا العملاء من خلال خدمات متميزة',
                'sub_text2_en' => 'We strive to achieve customer satisfaction through distinguished services',
            ]);
            $this->command->info('WhoUs data seeded successfully.');
        } else {
            $this->command->info('WhoUs data already exists, skipping seeding.');
        }
    }
}