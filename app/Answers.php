<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Questions;
class Answers extends Model
{
    public function questions()
    {
    	return $this->belongsTo(Questions::class, 'id');
    }
}
