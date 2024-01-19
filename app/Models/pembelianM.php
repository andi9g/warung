<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelianM extends Model
{
    use HasFactory;
    protected $table = "pembelian";
    protected $primaryKey = "idpembelian";
    protected $guarded = ['namabarang', 'satuan', 'harga', 'jumlahsekarang'];

    public function databarang()
    {
        return $this->hasOne(databarangM::class, "idbarang", "idbarang");
    }
}
