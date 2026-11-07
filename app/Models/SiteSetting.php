<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $primaryKey = 'key';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['key', 'value'];

    public static function defaults(): array
    {
        return [
            'site_name' => 'DOTiT Limited',
            'site_title' => 'DOTiT Limited | Technology & Digital Solutions',
            'site_description' => 'DOTiT Limited — Technology, software development, business automation, e-commerce and IT consultancy, with initOn as digital marketing partner.',
            'site_logo' => '',
            'site_favicon' => '',
            'hero_line_1' => 'Your Vision.',
            'hero_line_2' => 'Our Technology.',
            'hero_line_3' => 'Better Tomorrow.',
            'hero_text' => 'We build modern digital products, custom software and smart business solutions — then help your brand grow through our digital marketing partner, initOn.',
            'about_heading_start' => 'Technology that',
            'about_heading_highlight' => 'solves real problems.',
            'about_lead' => 'DOTiT Limited is a technology and digital solutions company focused on building practical, scalable and modern solutions for businesses.',
            'about_text' => 'From a high-converting landing page to a complete business management platform, we combine thoughtful design, reliable development and smart technology to help organizations work better and grow faster.',
            'about_story_heading' => 'Technology with purpose. Growth with direction.',
            'about_story_text' => 'We help businesses turn ideas into practical digital products through thoughtful strategy, dependable engineering and modern design. Every solution is built around real goals, real users and measurable progress.',
            'about_feature_image' => '',
            'about_logo_image' => '',
            'vision_heading' => 'Our Vision',
            'vision_text' => 'To become a trusted technology partner that helps organizations grow through simple, scalable and meaningful digital solutions.',
            'mission_heading' => 'Our Mission',
            'mission_text' => 'To design and deliver reliable technology, create lasting business value and provide an honest, thoughtful experience at every step.',
            'journey_heading' => 'Our Journey',
            'journey_intro' => 'A timeline of the ideas, milestones and progress that shaped DOTiT Limited.',
            'journey_items' => json_encode([
                ['year' => '2023', 'text' => 'DOTiT Limited began its journey with a clear focus: turning real business needs into practical digital solutions.'],
                ['year' => '2024', 'text' => 'We expanded our services and strengthened our team, delivering thoughtful websites, software and technology support.'],
                ['year' => '2025', 'text' => 'The company grew through reliable projects, long-term client relationships and solutions built for measurable business value.'],
                ['year' => '2026', 'text' => 'We continue to innovate, improve and build scalable technology for businesses ready for the future.'],
            ], JSON_UNESCAPED_SLASHES),
            'services_heading_start' => 'Built for your',
            'services_heading_highlight' => 'business.',
            'services_intro' => 'From idea to deployment, we create digital solutions around your actual needs.',
            'partner_intro' => 'Technology builds your digital foundation. initOn helps you reach the right audience, build your brand and drive measurable growth.',
            'contact_heading_start' => 'Have a project',
            'contact_heading_highlight' => 'in mind?',
            'contact_intro' => "Whether you need a website, software, automation or digital marketing — we're ready to talk.",
            'phone' => '+880 1606-593705',
            'email' => 'dotitbd10@gmail.com',
            'website' => 'www.dotitltd.com',
            'address' => 'Baitus Samania 14/1, Zilla School Road, Manoharpur, Cumilla, Bangladesh',
        ];
    }
}
