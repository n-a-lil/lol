<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }
}
