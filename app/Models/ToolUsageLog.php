<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolUsageLog extends Model
{
    protected $fillable = ['tool_id', 'user_id', 'ip_address', 'status'];

    public function tool() { return $this->belongsTo(Tool::class); }
    public function user() { return $this->belongsTo(User::class); }
}
