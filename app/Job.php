<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'approved'];

    /**
     * @return BelongsTo
     */
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
