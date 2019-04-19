<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_tests', 'test_id', 'user_id');
    }
}
