<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['exam_id','question','true_answer'];
    function answers() {
        return $this->hasMany(Answer::class);
    }
}
