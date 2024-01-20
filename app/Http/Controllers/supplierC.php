<?php

namespace App\Http\Controllers;

use App\Models\supplierM;
use Illuminate\Http\Request;

class supplierC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("pages.supplier.supplier");
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
        try{
            $data = $request->all();
            supplierM::create($data);

            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplierM  $supplierM
     * @return \Illuminate\Http\Response
     */
    public function show(supplierM $supplierM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplierM  $supplierM
     * @return \Illuminate\Http\Response
     */
    public function edit(supplierM $supplierM, $idsupplier)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplierM  $supplierM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplierM $supplierM, $idsupplier)
    {
        try{
            $data = $request->all();
            supplierM::where('idsupplier', $idsupplier)->first()->update($data);

            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplierM  $supplierM
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplierM $supplierM, $idsupplier)
    {
        try{
            supplierM::destroy($idsupplier);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
