<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answers;
class Questions extends Model
{
    public function answers()
    {
    	return $this->hasMany('App\Answers');
    }
}
