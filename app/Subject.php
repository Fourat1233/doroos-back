<?php

namespace App;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use Taggable;

    public function instructors() {
        return $this->belongsToMany(Instructor::class);
    }

    public function category() {
        return $this->belongsTo(SubjectCategory::class, 'category_id');
    }

}
