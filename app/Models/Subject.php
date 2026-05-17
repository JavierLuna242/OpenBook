<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public static function defaultSubjects()
    {
        return collect([
            'Álgebra Lineal', 'Bases de Datos', 'Cálculo Diferencial', 'Cálculo Integral',
            'Contabilidad', 'Derecho Constitucional', 'Economía', 'Estructuras de Datos',
            'Física Mecánica', 'Ingeniería de Software', 'Inglés I', 'Inglés II',
            'Programación I', 'Química General', 'Sistemas Operativos'
        ])->map(function($name) {
            return (object)['name' => $name];
        });
    }
}
