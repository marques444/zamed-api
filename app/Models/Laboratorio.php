<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    protected $fillable = ['nome'];

    public function exames() {
        return $this->hasMany(Exame::class);
    }
}
