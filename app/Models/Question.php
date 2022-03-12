<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getHasAnswerAttribute()
    {
        return $this->answers()->where('user_id', auth()->id())->exists();
    }
}
