<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;
use App\Models\ImageTemplate;

class ImageMakerSeeder extends Seeder
{
    public function run(): void
    {
        $nepaliCat = Category::where('slug', 'nepali-tools')->first();
        if (!$nepaliCat) return;

        Tool::updateOrCreate(
            ['slug' => 'nepali-image-maker'],
            [
                'category_id' => $nepaliCat->id,
                'name' => 'Nepali Quote & Social Media Image Maker',
                'slug' => 'nepali-image-maker',
                'description' => 'Create beautiful Nepali quotes, festival greetings, social media posts, and promotional images online.',
                'full_description' => 'Canvas-based graphic design tool for creating Nepali social media graphics, festival greetings, and motivational quotes with PNG/JPG export.',
                'icon' => 'image',
                'route_name' => 'tools.nepali.image-maker',
                'processing_mode' => 'client',
                'component_key' => 'nepali-image-maker',
                'is_featured' => true,
                'seo_title' => 'Nepali Image Maker Online – Create Nepali Quotes and Social Media Posts | ToolSathi',
                'seo_description' => 'Create beautiful Nepali quotes, festival greetings, social media posts and promotional images online. Add Nepali Unicode text, customize backgrounds and download your designs.'
            ]
        );

        ImageTemplate::updateOrCreate(
            ['title' => 'Dashain Festival Greeting'],
            ['category' => 'Festivals', 'design_data' => json_encode(['text' => 'शुभ विजया दशमी २०८३!', 'bg' => '#E83E46', 'color' => '#ffffff'])]
        );

        ImageTemplate::updateOrCreate(
            ['title' => 'Nepali Motivational Quote'],
            ['category' => 'Quotes', 'design_data' => json_encode(['text' => 'मेहनत गर्ने मान्छे कहिल्यै हार्दैन।', 'bg' => '#242B36', 'color' => '#ffffff'])]
        );
    }
}
