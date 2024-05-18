<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $table = 'entradas'; // Asegúrate de que el nombre de la tabla sea correcto

    protected static function boot()
    {
        parent::boot();

        // Observador antes de guardar
        static::saving(function ($entrada) {
            // Verificar si el estado 'asistio' está siendo actualizado a true
            if ($entrada->isDirty('asistio') && $entrada->asistio == true) {
                $entrada->fecha_asistio = now(); // Establece la fecha y hora actual
            }
            if ($entrada->isDirty('estado_pago') && $entrada->estado_pago == true) {
                $entrada->fecha_cobro = now(); // Establece la fecha y hora actual
            }
        });
    }
}
