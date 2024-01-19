<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class databarangM extends Model
{
    use HasFactory;
    protected $table = "databarang";
    protected $primaryKey = "iddatabarang";
    protected $guarded = ['tanggalmasuk', 'jumlah'];

    public function pembelian()
    {
        return $this->hasOne(pembelianM::class, "idbarang", "idbarang");
    }
    public function penjualan()
    {
        return $this->hasOne(penjualanM::class, "idbarang", "idbarang");
    }
}
