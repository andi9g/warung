<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplierM extends Model
{
    use HasFactory;
    protected $table = "supplier";
    protected $primaryKey = "idsupplier";
    protected $guarded = [];

    public function pembelian()
    {
        return $this->hasOne(pembelianM::class, "idsupplier", "idsupplier");
    }
}
