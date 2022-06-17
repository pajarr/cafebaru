<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';
    protected $fillable = ['nama_pelanggan','nama_menu','jumlah','total_harga','nama_pegawai'];
    public function menu(){
        return $this->belongsTo(Manager::class, 'id', 'id');
    }
}
