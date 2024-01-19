<?php

namespace App\Http\Controllers;

use App\Models\pembelianM;
use App\Models\databarangM;
use App\Models\penjualanM;
use Illuminate\Http\Request;
use PDF;

class laporanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function barangmasuk(Request $request)
    {
        return view("pages.laporan.masuk");
    }

    public function cetakmasuk(Request $request)
    {
        $request->validate([
            "tanggalawal" => "required",
            "tanggalakhir" => "required",
        ]);
        $tanggalawal = empty($request->tanggalawal)?date('Y-m-d'):$request->tanggalawal;
        $tanggalakhir = empty($request->tanggalakhir)?date('Y-m-d'):$request->tanggalakhir;

        $data = pembelianM::from('pembelian as p')
        ->leftJoin("databarang as b", "b.iddatabarang", "p.iddatabarang")
        ->select("p.iddatabarang","p.tanggalmasuk", "b.namabarang", "b.harga")
        ->selectRaw("sum(jumlah) as total")
        ->whereBetween("p.tanggalmasuk", [$tanggalawal, $tanggalakhir])
        ->groupBy("p.tanggalmasuk", "p.iddatabarang", "b.namabarang", "b.harga")
        ->get();

        $pdf = PDF::loadView("pages.laporan.laporanmasuk", [
            "data" => $data,
            "tanggalawal" => $tanggalawal,
            "tanggalakhir" => $tanggalakhir,
        ]);

        return $pdf->stream("laporanmasuk.pdf");

        
    }

    public function barangkeluar(Request $request)
    {
        return view("pages.laporan.keluar");
    }

    public function cetakkeluar(Request $request)
    {
        $request->validate([
            "tanggalawal" => "required",
            "tanggalakhir" => "required",
        ]);
        $tanggalawal = empty($request->tanggalawal)?date('Y-m-d'):$request->tanggalawal;
        $tanggalakhir = empty($request->tanggalakhir)?date('Y-m-d'):$request->tanggalakhir;

        $data = penjualanM::from('penjualan as p')
        ->leftJoin("databarang as b", "b.iddatabarang", "p.iddatabarang")
        ->select("p.iddatabarang","p.tanggalkeluar", "b.namabarang", "p.harga")
        ->selectRaw("sum(jumlah) as total")
        ->whereBetween("p.tanggalkeluar", [$tanggalawal, $tanggalakhir])
        ->groupBy("p.tanggalkeluar", "p.iddatabarang", "b.namabarang", "p.harga")
        ->get();

        $pdf = PDF::loadView("pages.laporan.laporankeluar", [
            "data" => $data,
            "tanggalawal" => $tanggalawal,
            "tanggalakhir" => $tanggalakhir,
        ]);

        return $pdf->stream("laporanmasuk.pdf");

        
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
