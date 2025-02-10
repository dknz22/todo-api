<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * Поля, которые можно массово заполнять.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'completed',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}