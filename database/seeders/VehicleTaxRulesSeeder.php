<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleTaxRule;

class VehicleTaxRulesSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            // Bagmati Province - Motorcycles
            ['province' => 'Bagmati Province', 'vehicle_category' => 'two-wheeler', 'vehicle_type' => 'motorcycle', 'cc_min' => 0, 'cc_max' => 125, 'fiscal_year' => '2080/81', 'annual_tax' => 3000, 'renewal_fee' => 250, 'source_title' => 'Bagmati Province Economic Act', 'source_url' => 'https://mof.bagmati.gov.np', 'verified_at' => '2024-07-01'],
            ['province' => 'Bagmati Province', 'vehicle_category' => 'two-wheeler', 'vehicle_type' => 'motorcycle', 'cc_min' => 126, 'cc_max' => 150, 'fiscal_year' => '2080/81', 'annual_tax' => 5000, 'renewal_fee' => 250, 'source_title' => 'Bagmati Province Economic Act', 'source_url' => 'https://mof.bagmati.gov.np', 'verified_at' => '2024-07-01'],
            ['province' => 'Bagmati Province', 'vehicle_category' => 'two-wheeler', 'vehicle_type' => 'motorcycle', 'cc_min' => 151, 'cc_max' => 225, 'fiscal_year' => '2080/81', 'annual_tax' => 6500, 'renewal_fee' => 250, 'source_title' => 'Bagmati Province Economic Act', 'source_url' => 'https://mof.bagmati.gov.np', 'verified_at' => '2024-07-01'],
            ['province' => 'Bagmati Province', 'vehicle_category' => 'two-wheeler', 'vehicle_type' => 'motorcycle', 'cc_min' => 226, 'cc_max' => 400, 'fiscal_year' => '2080/81', 'annual_tax' => 11000, 'renewal_fee' => 250, 'source_title' => 'Bagmati Province Economic Act', 'source_url' => 'https://mof.bagmati.gov.np', 'verified_at' => '2024-07-01'],
            
            // Bagmati Province - Scooters
            ['province' => 'Bagmati Province', 'vehicle_category' => 'two-wheeler', 'vehicle_type' => 'scooter', 'cc_min' => 0, 'cc_max' => 125, 'fiscal_year' => '2080/81', 'annual_tax' => 3000, 'renewal_fee' => 250, 'source_title' => 'Bagmati Province Economic Act', 'source_url' => 'https://mof.bagmati.gov.np', 'verified_at' => '2024-07-01'],
            ['province' => 'Bagmati Province', 'vehicle_category' => 'two-wheeler', 'vehicle_type' => 'scooter', 'cc_min' => 126, 'cc_max' => 250, 'fiscal_year' => '2080/81', 'annual_tax' => 5000, 'renewal_fee' => 250, 'source_title' => 'Bagmati Province Economic Act', 'source_url' => 'https://mof.bagmati.gov.np', 'verified_at' => '2024-07-01'],

            // Bagmati Province - Cars
            ['province' => 'Bagmati Province', 'vehicle_category' => 'four-wheeler', 'vehicle_type' => 'private car', 'cc_min' => 0, 'cc_max' => 1000, 'fiscal_year' => '2080/81', 'annual_tax' => 22000, 'renewal_fee' => 500, 'source_title' => 'Bagmati Province Economic Act', 'source_url' => 'https://mof.bagmati.gov.np', 'verified_at' => '2024-07-01'],
            ['province' => 'Bagmati Province', 'vehicle_category' => 'four-wheeler', 'vehicle_type' => 'private car', 'cc_min' => 1001, 'cc_max' => 1500, 'fiscal_year' => '2080/81', 'annual_tax' => 25000, 'renewal_fee' => 500, 'source_title' => 'Bagmati Province Economic Act', 'source_url' => 'https://mof.bagmati.gov.np', 'verified_at' => '2024-07-01'],
        ];

        foreach ($rules as $rule) {
            VehicleTaxRule::updateOrCreate(
                [
                    'province' => $rule['province'],
                    'vehicle_type' => $rule['vehicle_type'],
                    'cc_min' => $rule['cc_min'],
                    'cc_max' => $rule['cc_max'],
                    'fiscal_year' => $rule['fiscal_year']
                ],
                $rule
            );
        }
    }
}
