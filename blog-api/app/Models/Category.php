<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected static ?string $model = Category::class;
     
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'status',
    ];
        
    protected $casts=[
        'status'=>'boolean',
        'created_at'=>'datetime:Y-m-d H:i',
    ];

    public function categories()
    {
       return $this->belongsToMany(Post::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
