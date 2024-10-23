<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LoginLog extends Model
{
    use HasFactory;
    protected $table = 'login_logs';  
    protected $fillable = ['user_id', 'ip_address', 'user_agent']; // 假设还有其他字段 
    public function user()  
    {  
        return $this->belongsTo(User::class, 'user_id'); // 注意这里的 'user_id'  
    } 
}
