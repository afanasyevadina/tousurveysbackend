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
}