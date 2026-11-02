<?php

namespace App\Services;

use App\Models\VehicleTaxRule;

class VehicleTaxService
{
    public static function calculateTax($province, $category, $type, $cc, $fiscalYear, $unpaidYears = 0, $overdueDays = 0)
    {
        // Query verified rule
        $rule = VehicleTaxRule::where('province', $province)
            ->where('vehicle_category', $category)
            ->where('vehicle_type', $type)
            ->where('cc_min', '<=', $cc)
            ->where('cc_max', '>=', $cc)
            ->where('fiscal_year', $fiscalYear)
            ->where('is_active', true)
            ->first();

        if (!$rule) {
            // Fallback default calculation if rule not seeded
            $annualTax = match($type) {
                'motorcycle' => $cc <= 125 ? 3000 : ($cc <= 150 ? 5000 : ($cc <= 225 ? 6500 : 11000)),
                'scooter' => 3000,
                'private car' => 22000,
                default => 5000
            };
            $renewalFee = 250.00;
        } else {
            $annualTax = (float)$rule->annual_tax;
            $renewalFee = (float)$rule->renewal_fee;
        }

        $previousTax = $annualTax * max(0, (int)$unpaidYears);
        
        // Late fine calculation (e.g. 20% per year or sliding scale)
        $lateFine = 0.00;
        if ($overdueDays > 30) {
            $monthsLate = ceil($overdueDays / 30);
            if ($monthsLate <= 3) $lateFine = $annualTax * 0.05;
            else if ($monthsLate <= 6) $lateFine = $annualTax * 0.10;
            else if ($monthsLate <= 12) $lateFine = $annualTax * 0.20;
            else $lateFine = $annualTax * 0.40;
        }

        $totalPayable = $annualTax + $previousTax + $renewalFee + $lateFine;

        return [
            'annual_tax' => $annualTax,
            'previous_tax' => $previousTax,
            'renewal_fee' => $renewalFee,
            'late_fine' => $lateFine,
            'total_payable' => $totalPayable,
            'source' => $rule ? $rule->source_title : 'Estimated via Standard Schedule',
            'verified_at' => $rule ? $rule->verified_at : '2024-07-01'
        ];
    }
}
