<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question_de', 'question_en', 'question_fr', 'question_it', 'answer_de', 'answer_en', 'answer_fr', 'answer_it',
    ];
}
