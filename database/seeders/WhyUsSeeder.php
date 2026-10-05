<?php

namespace Database\Seeders;

use App\Models\WhyUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhyUsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if whyus data already exists
        if (WhyUs::count() == 0) {
            WhyUs::create([
                'main_text_ar' => 'لماذا نحن',
                'main_text_en' => 'Why Us?',
                'sub_text1_ar' => 'خبرة طويلة في مجال خدمات العمالة',
                'sub_text1_en' => 'Long experience in labor services',
                'sub_text2_ar' => 'مكاتب معتمدة وشركاء موثوقين',
                'sub_text2_en' => 'Accredited offices and trusted partners',
            ]);
            $this->command->info('WhyUs data seeded successfully.');
        } else {
            $this->command->info('WhyUs data already exists, skipping seeding.');
        }
    }
}