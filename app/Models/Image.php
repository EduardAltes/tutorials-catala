<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['tutorial_id', 'url', 'thumbnail'];

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }
}
