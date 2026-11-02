<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class Batch5CalculatorSeeder extends Seeder
{
    public function run(): void
    {
        $calcCat = Category::where('slug', 'calculators')->first();
        if (!$calcCat) $calcCat = Category::first();

        $tools = [
            [
                'category_id' => $calcCat->id,
                'name' => 'GST/VAT Calculator',
                'slug' => 'vat-calculator',
                'description' => 'Calculate Value Added Tax (VAT) or Goods and Services Tax (GST) easily.',
                'full_description' => 'Add or remove tax percentages from amounts with configurable tax rates.',
                'icon' => 'percent',
                'route_name' => 'tools.calc.vat',
                'processing_mode' => 'client',
                'component_key' => 'vat-calculator',
                'is_featured' => true,
                'seo_title' => 'GST & VAT Calculator Online Free - Add/Remove Tax | ToolSathi',
                'seo_description' => 'Calculate GST or VAT tax amounts and net totals online.'
            ],
            [
                'category_id' => $calcCat->id,
                'name' => 'Discount Calculator',
                'slug' => 'discount-calculator',
                'description' => 'Calculate final prices after percentage or fixed discounts.',
                'full_description' => 'Quickly determine savings and discounted final sale prices.',
                'icon' => 'tag',
                'route_name' => 'tools.calc.discount',
                'processing_mode' => 'client',
                'component_key' => 'discount-calculator',
                'is_featured' => false,
                'seo_title' => 'Discount Calculator Free - Sale Price Calculator | ToolSathi',
                'seo_description' => 'Calculate item discounts and final prices instantly online.'
            ],
            [
                'category_id' => $calcCat->id,
                'name' => 'Profit and Loss Calculator',
                'slug' => 'profit-loss-calculator',
                'description' => 'Calculate profit or loss amounts, margins, and percentages.',
                'full_description' => 'Determine business profit margins, markup percentages, and cost analysis.',
                'icon' => 'trending-up',
                'route_name' => 'tools.calc.profit-loss',
                'processing_mode' => 'client',
                'component_key' => 'profit-loss-calculator',
                'is_featured' => false,
                'seo_title' => 'Profit and Loss Calculator Free - Margin Calculator | ToolSathi',
                'seo_description' => 'Calculate business profit, loss, and margin percentages online.'
            ],
            [
                'category_id' => $calcCat->id,
                'name' => 'Loan Calculator',
                'slug' => 'loan-calculator',
                'description' => 'Comprehensive loan EMI, interest, and payment breakdown calculator.',
                'full_description' => 'Calculate monthly mortgage or loan payments with full amortization breakdown.',
                'icon' => 'dollar-sign',
                'route_name' => 'tools.calc.loan',
                'processing_mode' => 'client',
                'component_key' => 'loan-calculator',
                'is_featured' => true,
                'seo_title' => 'Loan Calculator Online Free - EMI & Interest | ToolSathi',
                'seo_description' => 'Calculate loan monthly installments and total interest payable.'
            ],
            [
                'category_id' => $calcCat->id,
                'name' => 'BMI Calculator',
                'slug' => 'bmi-calculator',
                'description' => 'Calculate Body Mass Index (BMI) and check health weight categories.',
                'full_description' => 'Assess body mass index using height and weight measurements (metric and imperial).',
                'icon' => 'activity',
                'route_name' => 'tools.calc.bmi',
                'processing_mode' => 'client',
                'component_key' => 'bmi-calculator',
                'is_featured' => false,
                'seo_title' => 'BMI Calculator Free - Body Mass Index Check | ToolSathi',
                'seo_description' => 'Calculate your Body Mass Index (BMI) and check weight categories.'
            ],
            [
                'category_id' => $calcCat->id,
                'name' => 'Compound Interest Calculator',
                'slug' => 'compound-interest-calculator',
                'description' => 'Calculate investment growth with compound interest and contributions.',
                'full_description' => 'Project future wealth growth over time using compound interest formulas.',
                'icon' => 'pie-chart',
                'route_name' => 'tools.calc.compound-interest',
                'processing_mode' => 'client',
                'component_key' => 'compound-interest-calculator',
                'is_featured' => false,
                'seo_title' => 'Compound Interest Calculator Free - Investment Growth | ToolSathi',
                'seo_description' => 'Calculate investment returns and compound interest growth over time.'
            ],
            [
                'category_id' => $calcCat->id,
                'name' => 'Currency Converter',
                'slug' => 'currency-converter',
                'description' => 'Convert amounts between major global currencies with exchange rates.',
                'full_description' => 'Convert fiat currencies using indicative exchange rates and timestamps.',
                'icon' => 'globe',
                'route_name' => 'tools.calc.currency',
                'processing_mode' => 'client',
                'component_key' => 'currency-converter',
                'is_featured' => true,
                'seo_title' => 'Currency Converter Online Free - Exchange Rates | ToolSathi',
                'seo_description' => 'Convert currencies worldwide with live exchange rate tools.'
            ],
            [
                'category_id' => $calcCat->id,
                'name' => 'GPA Calculator',
                'slug' => 'gpa-calculator',
                'description' => 'Calculate Grade Point Average (GPA) based on course credits and grades.',
                'full_description' => 'Compute cumulative GPA and credit totals across multiple subjects.',
                'icon' => 'award',
                'route_name' => 'tools.calc.gpa',
                'processing_mode' => 'client',
                'component_key' => 'gpa-calculator',
                'is_featured' => false,
                'seo_title' => 'GPA Calculator Free - Calculate Grade Point Average | ToolSathi',
                'seo_description' => 'Calculate your cumulative GPA and subject grade points easily.'
            ],
            [
                'category_id' => $calcCat->id,
                'name' => 'Age Difference Calculator',
                'slug' => 'age-difference-calculator',
                'description' => 'Calculate the exact age difference in years, months, and days between two dates.',
                'full_description' => 'Compare two birth dates to find exact age gaps and total days difference.',
                'icon' => 'calendar',
                'route_name' => 'tools.calc.age-difference',
                'processing_mode' => 'client',
                'component_key' => 'age-difference-calculator',
                'is_featured' => false,
                'seo_title' => 'Age Difference Calculator Free - Compare Birthdates | ToolSathi',
                'seo_description' => 'Calculate exact age difference in years, months, and days between dates.'
            ],
            [
                'category_id' => $calcCat->id,
                'name' => 'Business Day Calculator',
                'slug' => 'business-day-calculator',
                'description' => 'Calculate working days and business date intervals between dates.',
                'full_description' => 'Count business days excluding weekends and custom holidays.',
                'icon' => 'briefcase',
                'route_name' => 'tools.calc.business-day',
                'processing_mode' => 'client',
                'component_key' => 'business-day-calculator',
                'is_featured' => false,
                'seo_title' => 'Business Day Calculator Free - Working Days Count | ToolSathi',
                'seo_description' => 'Calculate working days and business intervals between calendar dates.'
            ]
        ];

        foreach ($tools as $toolData) {
            Tool::firstOrCreate(['slug' => $toolData['slug']], $toolData);
        }
    }
}
