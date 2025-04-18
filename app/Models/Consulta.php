<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = ['data', 'id_paciente', 'id_medico'];

    public function paciente() {
        return $this->belongsTo(Paciente::class);
    }

    public function medico() {
        return $this->belongsTo(Medico::class);
    }
}
