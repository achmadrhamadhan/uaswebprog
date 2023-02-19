<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    protected $fillable = [
        'id',
        'pengarang_id',
        'penerbit_id',
        'status',
        'nama',
        'genre',
        'tahun',
        'sinopsis',
    ];

    public $incrementing = true;

    public $timestamps = true;

    public function pengarang(){
        return $this->belongsTo(Pengarang::class, 'pengarang_id', 'id');
    }

    public function penerbit(){
        return $this->belongsTo(Penerbit::class, 'penerbit_id', 'id');
    }

}
