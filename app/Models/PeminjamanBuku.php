<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBuku extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_bukus';

    protected $fillable = [
        'id',
        'buku_id',
        'user_id',
        'status'
    ];

    public $incrementing = true;

    public $timestamps = true;

    public function buku(){
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
