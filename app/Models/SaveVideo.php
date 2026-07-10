<?php

namespace App\Models;
use App\Models\SaveVideo;
use Illuminate\Database\Eloquent\Model;

class savevideo extends Model
{
    protected $fillable = [
        'user_id',
        'video_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
