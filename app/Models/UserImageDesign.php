<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserImageDesign extends Model
{
    protected $fillable = ['user_id', 'title', 'design_data'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
