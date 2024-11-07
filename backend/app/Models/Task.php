<?php

namespace App\Models;

use App\Models\User;
use App\Models\Situation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'situation_id',
        'task_name',
        'description',
        'data_tak',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); #Tarefa pertence há um Usuario
    }

    public function situation()
    {
        return $this->belongsTo(Situation::class); #Situação pertence há um Tarefa
    }
}
