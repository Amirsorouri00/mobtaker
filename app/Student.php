<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Teacher;
class Student extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher');
    }
}
