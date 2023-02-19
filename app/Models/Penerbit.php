<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;

    protected $table = 'penerbits';

    protected $fillable = [
        'id',
        'nama',
        'alamat'
    ];

    public $incrementing = true;

    public $timestamps = true;
}
