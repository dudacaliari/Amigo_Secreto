<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    // Definindo os campos que podem ser preenchidos
    protected $fillable = ['nome'];

    /**
     * Relacionamento com Pessoa (Muitos-para-Muitos).
     */
    public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class, 'pessoa_gift');
    }
}
