<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'parent_id', 'sort', 'description', 'icon', 'created_at', 'updated_at'
    ];
    
    // 获取所有子菜单项  
    public function children()  
    {  
        return $this->hasMany(Types::class, 'parent_id', 'id');  
    }

    // 可选：获取父菜单项（如果这是一个子菜单项） 
    public function parent()  
    {  
        return $this->belongsTo(Types::class, 'parent_id');  
    }

    // 可选：递归获取所有后代  
    public function descendants()  
    {  
        return $this->children()->with('descendants');  
    }  
}
