<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Follow extends Model
{
    use HasFactory;
    protected $table = 'follows';

    protected $fillable = [
        'follower_id',
        'followed_id',
    ];

}
