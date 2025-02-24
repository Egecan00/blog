<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected static ?string $model = Category::class;

    protected $fillable = ['name'];
}
