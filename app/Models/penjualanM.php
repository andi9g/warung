<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualanM extends Model
{
    use HasFactory;
    protected $table = "penjualan";
    protected $primaryKey = "idpenjualan";
    protected $guarded = ['namabarang', 'satuan', 'jumlahsekarang'];

    public function databarang()
    {
        return $this->hasOne(databarangM::class, "idbarang", "idbarang");
    }
}
