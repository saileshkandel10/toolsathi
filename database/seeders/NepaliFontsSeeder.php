<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NepaliFont;
use App\Models\Tool;
use App\Models\Category;

class NepaliFontsSeeder extends Seeder
{
    public function run(): void
    {
        $nepaliCat = Category::where('slug', 'nepali-tools')->first();
        if ($nepaliCat) {
            Tool::updateOrCreate(
                ['slug' => 'nepali-fonts'],
                [
                    'category_id' => $nepaliCat->id,
                    'name' => 'Nepali Font Library',
                    'slug' => 'nepali-fonts',
                    'description' => 'Browse, search, preview, and download free Nepali Unicode and Preeti-compatible fonts.',
                    'full_description' => 'Explore our curated Nepali font library featuring Unicode Devanagari and legacy Preeti fonts with custom text previews and download options.',
                    'icon' => 'type',
                    'route_name' => 'tools.nepali.fonts',
                    'processing_mode' => 'client',
                    'component_key' => 'nepali-fonts',
                    'is_featured' => true,
                    'seo_title' => 'Nepali Font Library - Download Free Unicode & Preeti Fonts | ToolSathi',
                    'seo_description' => 'Browse and download free Nepali Unicode Devanagari and legacy Preeti fonts with live text previews.'
                ]
            );
        }

        $fonts = [
            ['name' => 'Mukta Devanagari', 'slug' => 'mukta-devanagari', 'category' => 'Unicode Devanagari', 'author' => 'Adobe', 'format' => 'TTF', 'license' => 'Open Source', 'sample_text' => 'नेपाली भाषा र संस्कृति', 'is_featured' => true],
            ['name' => 'Kalimati', 'slug' => 'kalimati', 'category' => 'Unicode Devanagari', 'author' => 'Madhab Sharma', 'format' => 'TTF', 'license' => 'Free', 'sample_text' => 'सुन्दर नेपाल हाम्रो देश', 'is_featured' => true],
            ['name' => 'Preeti Classic', 'slug' => 'preeti-classic', 'category' => 'Preeti-compatible', 'author' => 'Mandala', 'format' => 'TTF', 'license' => 'Free', 'sample_text' => 'lcdf g]kfnL zAb', 'is_featured' => false],
            ['name' => 'Kantipur', 'slug' => 'kantipur', 'category' => 'Preeti-compatible', 'author' => 'Kantipur Publications', 'format' => 'TTF', 'license' => 'Free', 'sample_text' => 'g]kfnL', 'is_featured' => false],
            ['name' => 'Mangal', 'slug' => 'mangal', 'category' => 'Unicode Devanagari', 'author' => 'Microsoft', 'format' => 'OTF', 'license' => 'Commercial', 'sample_text' => 'स्वागत छ ToolSathi मा', 'is_featured' => false],
        ];

        foreach ($fonts as $font) {
            NepaliFont::updateOrCreate(['slug' => $font['slug']], $font);
        }
    }
}
