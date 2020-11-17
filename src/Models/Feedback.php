<?php

namespace Qihucms\Feedback\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'content', 'file', 'contact', 'reply', 'status'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
