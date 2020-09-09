<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'lat', 'long'
    ];

    public function manager()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function classes()
    {
        return $this->hasMany('App\Classs');
    }
}
