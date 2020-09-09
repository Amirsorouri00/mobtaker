<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    protected $guarded = ['id'];

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }
}
