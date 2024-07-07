<?php

namespace App\Models;


use App\Events\FeedCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feed extends Model
{

    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => FeedCreated::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
