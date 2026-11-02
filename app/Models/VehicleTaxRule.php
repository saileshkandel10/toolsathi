<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleTaxRule extends Model
{
    protected $fillable = [
        'province', 'vehicle_category', 'vehicle_type', 'cc_min', 'cc_max',
        'fiscal_year', 'annual_tax', 'renewal_fee', 'source_title', 'source_url',
        'verified_at', 'is_active'
    ];
}
