<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function question()
    {
        return $this->belongsTo(Question::class)->withDefault();
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class)->withDefault();
    }
}
