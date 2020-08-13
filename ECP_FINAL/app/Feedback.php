<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = '_feedbacks';

    protected $fillable = [
        'topic', 'feedback'
    ];
}
