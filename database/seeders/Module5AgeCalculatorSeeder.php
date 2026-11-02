<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class Module5AgeCalculatorSeeder extends Seeder
{
    public function run(): void
    {
        $nepaliCat = Category::where('slug', 'nepali-tools')->first();
        if (!$nepaliCat) return;

        Tool::updateOrCreate(
            ['slug' => 'age-calculator-bs-ad'],
            [
                'category_id' => $nepaliCat->id,
                'name' => 'Nepali Age Calculator (BS and AD)',
                'slug' => 'age-calculator-bs-ad',
                'description' => 'Calculate your exact age in years, months, and days using Nepali BS or English AD date of birth.',
                'full_description' => 'Calculate precise age, total elapsed days, and upcoming birthdays using Bikram Sambat (BS) or Gregorian (AD) calendars.',
                'icon' => 'clock',
                'route_name' => 'tools.nepali.age-calculator-bs-ad',
                'processing_mode' => 'client',
                'component_key' => 'age-calculator-bs-ad',
                'is_featured' => true,
                'seo_title' => 'Nepali Age Calculator – Calculate Age in BS and AD Online | ToolSathi',
                'seo_description' => 'Calculate your exact age in years, months and days using your Nepali BS or English AD date of birth.'
            ]
        );
    }
}
