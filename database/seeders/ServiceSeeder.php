<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if service data already exists
        if (Service::count() == 0) {
            Service::create([
                'main_text_ar' => 'خدماتنا',
                'main_text_en' => 'Our Services',
                'service_image' => 'images/card4.jpg',
                'title_text_ar' => 'خدمات استقدام العمالة',
                'title_text_en' => 'Labor Recruitment Services',
                'description_text_ar' => 'نوفر خدمات استقدام العمالة المنزلية والعاملة من خلال مكاتب معتمدة وإجراءات سريعة.',
                'description_text_en' => 'We provide domestic and labor recruitment services through accredited offices and fast procedures.',
                'button_text1_ar' => 'طلب خدمة',
                'button_text1_en' => 'Request Service',
                'button_text2_ar' => 'تواصل معنا',
                'button_text2_en' => 'Contact Us',
            ]);
            $this->command->info('Service data seeded successfully.');
        } else {
            $this->command->info('Service data already exists, skipping seeding.');
        }
    }
}