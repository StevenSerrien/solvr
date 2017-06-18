<?php

namespace App\Models\Answer;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $guarded = [
    'id',
  ];

  public function question() {
    return $this->belongsTo('App\Models\Question\Question');
  }
}
