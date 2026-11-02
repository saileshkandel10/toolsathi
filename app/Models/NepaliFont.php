<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NepaliFont extends Model
{
    protected $fillable = [
        'name', 'slug', 'category', 'author', 'format', 'license',
        'sample_text', 'file_path', 'source_url', 'is_active', 'is_featured'
    ];
}
