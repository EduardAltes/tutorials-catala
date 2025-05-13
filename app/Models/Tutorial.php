<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'summary', 'category_id', 'is_translated', 'is_reviewed', 'difficulty', 'time_required_min', 'time_required_max'];

    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy('order');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

}
