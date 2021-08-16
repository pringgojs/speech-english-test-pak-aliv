<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function variants()
    {
        return $this->hasMany(QuestionAnswerVariant::class);
    }
}
