@extends('layouts.admin')

@section("openlaporan", "menu-open")

@section("warnalaporan", "active")

@section("transaksilaporanpenjualan", "active")

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Barang Keluar</h3></div>
                <form action="{{ route('cetak.keluar', []) }}" method="get" target="_blank">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggalawal">Tanggal Awal</label>
                            <input id="tanggalawal" class="form-control" value="{{ date("Y-m-d") }}" type="date" name="tanggalawal">
                        </div>
                        <div class="form-group">
                            <label for="tanggalakhir">Tanggal Akhir</label>
                            <input id="tanggalakhir" class="form-control" value="{{ date("Y-m-d") }}" type="date" name="tanggalakhir">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">PRINT</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
</div> 

@endsection