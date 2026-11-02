<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class NepaliUnicodeSeeder extends Seeder
{
    public function run(): void
    {
        $nepaliCat = Category::where('slug', 'nepali-tools')->first();
        if (!$nepaliCat) return;

        $tools = [
            [
                'category_id' => $nepaliCat->id,
                'name' => 'Preeti to Unicode Converter',
                'slug' => 'preeti-to-unicode',
                'description' => 'Convert text typed using the legacy Preeti font encoding into standard Nepali Unicode.',
                'full_description' => 'Genuine bidirectional Preeti character mapping engine handling matras, conjuncts, reph, and special combinations into standard Nepali Unicode.',
                'icon' => 'type',
                'route_name' => 'tools.nepali.preeti-to-unicode',
                'processing_mode' => 'client',
                'component_key' => 'preeti-to-unicode',
                'is_featured' => true,
                'seo_title' => 'Preeti to Unicode Converter Free - Nepali Font Converter | ToolSathi',
                'seo_description' => 'Convert legacy Preeti font text into standard Nepali Unicode instantly online with perfect formatting.'
            ],
            [
                'category_id' => $nepaliCat->id,
                'name' => 'Unicode to Preeti Converter',
                'slug' => 'unicode-to-preeti',
                'description' => 'Convert standard Nepali Unicode text into the legacy Preeti font encoding.',
                'full_description' => 'Convert standard Nepali Unicode text back to legacy Preeti font encoding with accurate character mapping.',
                'icon' => 'repeat',
                'route_name' => 'tools.nepali.unicode-to-preeti',
                'processing_mode' => 'client',
                'component_key' => 'unicode-to-preeti',
                'is_featured' => true,
                'seo_title' => 'Unicode to Preeti Converter Free - Nepali Unicode to Legacy | ToolSathi',
                'seo_description' => 'Convert standard Nepali Unicode text into legacy Preeti font encoding instantly.'
            ]
        ];

        foreach ($tools as $toolData) {
            Tool::updateOrCreate(['slug' => $toolData['slug']], $toolData);
        }
    }
}
