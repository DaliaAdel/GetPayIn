<?php

namespace App\Models;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    public function platforms() {
        return $this->belongsToMany(Platform::class)->withPivot('platform_status')->withTimestamps();
    }

}
