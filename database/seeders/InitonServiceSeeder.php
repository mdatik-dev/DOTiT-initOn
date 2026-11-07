<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class InitonServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['Facebook Marketing & Advertising', 'Targeted Facebook campaigns that grow brand visibility, engagement and leads.', 'fa-solid fa-bullhorn'],
            ['Creative Design & Branding', 'Professional visual identities, campaign creatives and brand-focused design.', 'fa-solid fa-palette'],
            ['Video Editing & Content Creation', 'Engaging video content and creative edits built for social media audiences.', 'fa-solid fa-film'],
            ['Social Media Management', 'Consistent planning, publishing and community management across social platforms.', 'fa-solid fa-mobile-screen-button'],
            ['SEO & Digital Growth', 'Search optimization and growth strategies that improve visibility and traffic.', 'fa-solid fa-magnifying-glass-chart'],
            ['Website & Landing Page Promotion', 'Promotion strategies designed to attract visitors and support conversions.', 'fa-solid fa-globe'],
            ['Digital Advertising', 'Multi-platform digital ad campaigns aligned with clear business objectives.', 'fa-solid fa-chart-column'],
            ['Facebook Ads Run & Management', 'Complete Facebook advertising setup, optimization and performance management.', 'fa-solid fa-rectangle-ad'],
            ['Meta Ads Campaign Management', 'Meta campaign planning and optimization across Facebook and Instagram placements.', 'fa-solid fa-crosshairs'],
            ['Lead Generation Campaigns', 'Campaign systems designed to capture, qualify and nurture potential customers.', 'fa-solid fa-chart-line'],
            ['Conversion & Sales Campaigns', 'Conversion-focused campaigns created to improve sales and customer actions.', 'fa-solid fa-money-bill-trend-up'],
            ['Ad Targeting & Audience Research', 'Audience research and precise targeting based on behavior, interests and intent.', 'fa-solid fa-users-viewfinder'],
            ['Retargeting & Remarketing', 'Re-engagement campaigns that bring interested users back to complete actions.', 'fa-solid fa-rotate'],
            ['Complete Digital Marketing Solutions', 'An integrated digital marketing strategy covering creative, media and growth.', 'fa-solid fa-rocket'],
        ];

        foreach ($services as $index => [$name, $description, $icon]) {
            Service::query()->updateOrCreate(
                ['name' => $name, 'category' => 'initon'],
                [
                    'description' => $description,
                    'icon' => $icon,
                    'link_label' => 'Discuss',
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }
}
