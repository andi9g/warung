<?php

namespace App\Http\Controllers;

use App\Models\pembelianM;
use App\Models\databarangM;
use App\Models\penjualanM;
use Illuminate\Http\Request;

class penjualanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tanggal = empty($request->tanggal)?date('Y-m-d'):$request->tanggal;
        $keyword = empty($request->keyword)?'':$request->keyword;
        

        $data = penjualanM::from('penjualan as p')
        ->leftJoin("databarang as b", "b.iddatabarang", "p.iddatabarang")
        ->select("p.iddatabarang","p.tanggalkeluar", "b.namabarang", "p.harga")
        ->selectRaw("sum(jumlah) as total")
        ->where("p.tanggalkeluar","like", $tanggal."%")
        ->where("b.namabarang","like", "%".$keyword."%")
        ->groupBy("p.tanggalkeluar", "p.iddatabarang", "b.namabarang", "p.harga")
        ->paginate(15);

        $data->appends($request->only(['keyword', 'limit']));
        // dd($data);
        return view("pages.transaksi.penjualan", [
            "keyword" => $keyword,
            "tanggal" => $tanggal,
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penjualanM  $penjualanM
     * @return \Illuminate\Http\Response
     */
    public function show(penjualanM $penjualanM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penjualanM  $penjualanM
     * @return \Illuminate\Http\Response
     */
    public function edit(penjualanM $penjualanM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\penjualanM  $penjualanM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penjualanM $penjualanM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penjualanM  $penjualanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(penjualanM $penjualanM)
    {
        //
    }
}
