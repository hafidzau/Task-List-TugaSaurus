<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Task.php
class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'deadline',
        'user_id'
    ];

    protected $attributes = [
        'status' => 'pending',
        'priority' => 'low'
    ];


    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
