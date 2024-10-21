<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = ['nome', 'email'];
}