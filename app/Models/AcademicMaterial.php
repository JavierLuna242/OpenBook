<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicMaterial extends Model
{
    protected $fillable = [
        'tutor_id',
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size'
    ];

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}
