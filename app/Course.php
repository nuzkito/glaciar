<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
            ->withTimestamps();
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
