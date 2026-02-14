<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'student';

    protected $fillable = [
        'id',
        'nombre',
        'correo',
        'fechaNacimiento'
    ];
}
