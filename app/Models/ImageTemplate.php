<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageTemplate extends Model
{
    protected $fillable = ['title', 'category', 'preview_url', 'design_data', 'is_active'];
}
