@extends('layouts.admin')

@section("open", "menu-open")
@section("warnatransaksi", "active")
@section("transaksipenjualan", "active")

@section('content')



<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mb-3">
            <form action="{{ url()->current() }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input id="tanggal" class="form-control" type="date" value="{{ $tanggal }}" name="tanggal" onchange="submit()">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group">
                            <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="cari nama" aria-label="cari nama" aria-describedby="keyword">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text" id="keyword">Cari</button>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th width="5px">No</th>
                        <th>Tanggal Keluar</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Total Pendapatan</th>
                        
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggalkeluar)->isoFormat("DD MMMM Y") }}</td>
                        <td>{{ $item->namabarang }}</td>
                        <td>{{ $item->total }}</td>
                        <td>Rp{{ number_format($item->total * $item->harga, 0 ,",", ".") }}</td>
                        


                    </tr>

                   
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            {{ $data->links("vendor.pagination.bootstrap-4") }}
        </div>
    </div>
</div>

@endsection