<?php

namespace App\Http\Controllers;

use App\Models\pembelianM;
use App\Models\databarangM;
use App\Models\penjualanM;
use Illuminate\Http\Request;

class pembelianC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $keyword = empty($request->keyword)?'':$request->keyword;

        $data = databarangM::from('databarang as b')
        ->join('pembelian as p', 'p.iddatabarang', 'b.iddatabarang')
        ->select("b.iddatabarang", "b.namabarang", "b.harga")
        ->selectRaw('((sum(p.jumlah)) ) as totaljumlah')
        ->groupBy('b.iddatabarang','b.namabarang', 'b.harga')
        ->where("namabarang", "like", "%$keyword%")
        ->paginate(15);

        $data->appends($request->only(['keyword', 'limit']));

        // dd($data);
        return view("pages.transaksi.pembelian", [
            "keyword" => $keyword,
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ubahjumlah(Request $request)
    {
        try{
            if($request->jumlah == 0 ) {
                return redirect()->back()->with('error', 'Terjadi kesalahan 1');
            }

            $sekarang = $request->jumlahsekarang;
            $jumlah = $request->jumlah;
            if($sekarang < 1) {
                $hitung =  $jumlah - $sekarang; 

            }else {
                $hitung =  $sekarang - $jumlah; 

            }
            if($hitung < 0) {
                return redirect()->back()->with('error', 'Terjadi kesalahan');
            }

            $data = $request->all();
            pembelianM::create($data);

            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function barangkeluar(Request $request)
    {
        try{
            if($request->jumlah == 0 ) {
                return redirect()->back()->with('error', 'Terjadi kesalahan');
            }
            $jumlah = $request->jumlahsekarang;
            
            $hitung = $jumlah - $request->jumlah; 
            if($hitung < 0) {
                return redirect()->back()->with('error', 'Terjadi kesalahan');
            }
            
            $data = $request->all();
            penjualanM::create($data);

            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            
            $data = $request->all();
            
            $tambah = databarangM::create($data);

            $data['iddatabarang'] = $tambah->iddatabarang;
            pembelianM::create($data);
            
            return redirect()->back()->with('success', 'Success');
            

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pembelianM  $pembelianM
     * @return \Illuminate\Http\Response
     */
    public function show(pembelianM $pembelianM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pembelianM  $pembelianM
     * @return \Illuminate\Http\Response
     */
    public function edit(pembelianM $pembelianM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pembelianM  $pembelianM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pembelianM $pembelianM, $iddatabarang)
    {
        try{
            $data = $request->all();
            databarangM::where("iddatabarang", $iddatabarang)->first()->update($data);
            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pembelianM  $pembelianM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pembelianM $pembelianM)
    {
        //
    }
}
