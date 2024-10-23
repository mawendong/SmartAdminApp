<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Articles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'slug', 
        'title', 
        'types_id', 
        'user_id', 
        'keywords', 
        'description', 
        'content', 
        'author', 
        'source', 
        'cover', 
        'status', 
        'views', 
        'likes', 
        'created_at', 
        'updated_at'
    ];
    

    protected $dates = ['published_at'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (! $this->exists) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    //添加作用域来仅获取未删除的文章
    public function scopeActive($query)  
    {  
        return $query->whereNull('deleted_at');  
    }  
}
