<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $table = 'tb_menu';
    protected $fillable = ['nama_menu','harga','deskripsi','ketersediaan'];
    public function kasir(){
        return $this->hasmany(Kasir::class);
    }
}
