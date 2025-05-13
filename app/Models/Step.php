<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['tutorial_id', 'order', 'title'];

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
