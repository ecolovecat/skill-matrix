<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $table = 'skills';
    protected $fillable = [
            'skill_name',
    ];

    public function user() {
        return $this->belongsToMany(Skill::class, 'user_skill', 'skill_id', 'user_id')->withTimestamps()
            ->withPivot('level')
            ->withPivot('day');
    }

}
