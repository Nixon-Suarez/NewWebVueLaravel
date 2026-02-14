<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class enrollment extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'enrollment';

    protected $fillable = [
        'id',
        'studentId',
        'cursoId',
        'fecha'
    ];
}
