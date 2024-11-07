<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Situation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'color',
        'description',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class); #Situação pertence há uma Tarefa
    }
}
