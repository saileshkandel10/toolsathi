<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class Module6LandConverterSeeder extends Seeder
{
    public function run(): void
    {
        $nepaliCat = Category::where('slug', 'nepali-tools')->first();
        if (!$nepaliCat) return;

        Tool::updateOrCreate(
            ['slug' => 'land-measurement-converter'],
            [
                'category_id' => $nepaliCat->id,
                'name' => 'Nepal Land Measurement Converter',
                'slug' => 'land-measurement-converter',
                'description' => 'Convert Ropani, Aana, Paisa, Daam, Bigha, Kattha, Dhur, Square Feet and Square Meter online with mixed-unit calculator and land price estimator.',
                'full_description' => 'Comprehensive Nepal land measurement converter supporting Hill and Terai systems, mixed-unit calculations, and land valuation.',
                'icon' => 'maximize-2',
                'route_name' => 'tools.nepali.land-measurement-converter',
                'processing_mode' => 'client',
                'component_key' => 'land-measurement-converter',
                'is_featured' => true,
                'seo_title' => 'Nepal Land Measurement Converter – Ropani, Aana, Bigha, Kattha | ToolSathi',
                'seo_description' => 'Convert Ropani, Aana, Paisa, Daam, Bigha, Kattha, Dhur, Square Feet and Square Meter online. Includes mixed land measurement and land price calculator.'
            ]
        );
    }
}
