<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    protected $fillable = ['tipo', 'resultado', 'id_paciente', 'id_medico', 'id_laboratorio'];

    public function paciente() {
        return $this->belongsTo(Paciente::class);
    }

    public function medico() {
        return $this->belongsTo(Medico::class);
    }

    public function laboratorio() {
        return $this->belongsTo(Laboratorio::class);
    }
}
