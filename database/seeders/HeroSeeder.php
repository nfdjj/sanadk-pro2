<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if hero data already exists
        if (Hero::count() == 0) {
            Hero::create([
                'title_ar' => 'سندك برو',
                'title_en' => 'Sandak Pro',
                'content_ar' => 'حلول موثوقة لخدمات العمالة - نوفر خدمات العمالة عبر مكاتب معتمدة بإجراءات واضحة وإنجاز سريع.',
                'content_en' => 'Reliable solutions for labor services - We provide labor services through accredited offices with clear procedures and fast completion.',
            ]);
            $this->command->info('Hero data seeded successfully.');
        } else {
            $this->command->info('Hero data already exists, skipping seeding.');
        }
    }
}