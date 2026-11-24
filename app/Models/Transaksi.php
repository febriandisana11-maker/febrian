<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pembeli', 'buah_id', 'jumlah', 'total_harga'];

    public function buah()
    {
        return $this->belongsTo(Buah::class, 'buah_id');
    }
}