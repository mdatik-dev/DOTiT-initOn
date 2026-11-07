<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(InitonServiceSeeder::class);
        $clients = ['CZASS', 'Dr. Priom', 'ABC School', 'BXS School', 'Bigyan Collage', 'Madical Collage', 'Doctor Tarek'];
        foreach ($clients as $index => $name) {
            Client::query()->firstOrCreate(['name' => $name], [
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
        foreach (SiteSetting::defaults() as $key => $value) {
            SiteSetting::query()->firstOrCreate(['key' => $key], ['value' => $value]);
        }

        $services = [
            ['Landing Page', 'High-converting landing pages for products, services, campaigns and offers.', 'fa-solid fa-window-maximize'],
            ['Website Development', 'Professional, responsive and fast websites that represent your brand.', 'fa-solid fa-globe'],
            ['Web Application', 'Scalable, user-friendly web applications tailored to your workflow.', 'fa-solid fa-laptop-code'],
            ['Custom Software', 'Purpose-built software designed around your processes and requirements.', 'fa-solid fa-gears'],
            ['Business Automation', 'Reduce repetitive work and streamline operations with smart automation.', 'fa-solid fa-robot'],
            ['E-Commerce Solutions', 'Modern online stores with the tools you need to sell and scale.', 'fa-solid fa-cart-shopping'],
            ['IT Consultancy', 'Technology strategy and guidance for smarter business decisions.', 'fa-solid fa-compass-drafting'],
            ['Digital Transformation', 'Connect technology, automation and digital growth into one ecosystem.', 'fa-solid fa-wand-magic-sparkles'],
        ];

        foreach ($services as $index => [$name, $description, $icon]) {
            Service::query()->firstOrCreate(
                ['name' => $name],
                [
                    'description' => $description,
                    'icon' => $icon,
                    'link_label' => $index === 7 ? 'Start Now' : 'Discuss',
                    'is_featured' => $index === 7,
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }

    }
}
