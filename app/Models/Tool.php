<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'icon', 
        'route_name', 'views_count', 'is_featured', 'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
