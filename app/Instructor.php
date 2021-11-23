<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'about', 'state', 'city', 'teaching_type', 'teaching_areas', 'teaching_level',
        'pricing', 'years_of_experience', 'business_hours'
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class);
    }

    public function attachments() {
        return $this->hasMany(Attachment::class);
    }

    public function scopeTrusted($query) {
        return $query->where('is_trusted', true);
    }

}
