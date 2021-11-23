<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectCategory extends Model
{
    public function subjects () {
        return $this->hasMany(Subject::class, 'category_id');
    }
}
