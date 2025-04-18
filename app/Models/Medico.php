<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = ['nome', 'crm'];

    public function consultas() {
        return $this->hasMany(Consulta::class);
    }

    public function receitas() {
        return $this->hasMany(Receita::class);
    }

    public function exames() {
        return $this->hasMany(Exame::class);
    }
}

