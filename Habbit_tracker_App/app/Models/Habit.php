<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'emoji',
        'description',
        'streak',
        'completed',
    ];

    protected $casts = [
        'completed' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
