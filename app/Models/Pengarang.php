<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;

    protected $table = 'pengarangs';

    protected $fillable = [
        'id',
        'nama',
        'jenis_kelamin',
        'negara',
        'created_at',
        'updated_at'
    ];

    public $incrementing = true;

    public $timestamps = true;
}
