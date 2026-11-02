<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class Module8VehicleTaxSeeder extends Seeder
{
    public function run(): void
    {
        $nepaliCat = Category::where('slug', 'nepali-tools')->first();
        if (!$nepaliCat) $nepaliCat = Category::first();

        Tool::updateOrCreate(
            ['slug' => 'vehicle-bluebook-tax-calculator'],
            [
                'category_id' => $nepaliCat->id,
                'name' => 'Nepal Vehicle Bluebook Tax & Renewal Fine Calculator',
                'slug' => 'vehicle-bluebook-tax-calculator',
                'description' => 'Calculate estimated Nepal vehicle bluebook tax, renewal fees, and late fines by province, vehicle type, engine CC and fiscal year.',
                'full_description' => 'Calculate annual vehicle tax, late renewal penalties, and total payable bluebook renewal fees across all 7 provinces of Nepal.',
                'icon' => 'truck',
                'route_name' => 'tools.calc.vehicle-tax',
                'processing_mode' => 'client',
                'component_key' => 'vehicle-bluebook-tax-calculator',
                'is_featured' => true,
                'seo_title' => 'Nepal Vehicle Bluebook Tax Calculator – Bike, Scooter & Car Tax | ToolSathi',
                'seo_description' => 'Calculate estimated Nepal vehicle bluebook tax, renewal fees and late fines by province, vehicle type, engine CC and fiscal year.'
            ]
        );
    }
}
