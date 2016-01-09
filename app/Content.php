<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Content extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getParsedBodyAttribute()
    {
        return Parsedown::instance()->text($this->attributes['body']);
    }
}
