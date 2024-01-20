@extends('layouts.admin')

@section("open", "menu-open")
@section("warnatransaksi", "active")
@section("transaksipembelian", "active")

@section('content')
    
<div id="tambahbarang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Tambah Barang</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pembelian.store', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namabarang">Nama Barang</label>
                        <input id="namabarang" class="form-control" type="text" name="namabarang">
                    </div>
    
                    <div class="form-group">
                        <label for="tanggalmasuk">Tanggal Masuk</label>
                        <input id="tanggalmasuk" class="form-control" value="{{ date('Y-m-d') }}" type="date" name="tanggalmasuk">
                    </div>
    
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input id="jumlah" value="1" class="form-control" value="{{ date('Y-m-d') }}" type="number" name="jumlah">
                    </div>
    
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input id="harga" value="1" class="form-control" value="{{ date('Y-m-d') }}" type="number" name="harga">
                    </div>
                    
                    <div class="form-group">
                        <label for="idsupplier">Supplier</label>
                        <select id="idsupplier" class="form-control" name="idsupplier">
                            @foreach ($supplier as $s)
                            <option value="{{ $s->idsupplier }}">{{ $s->namasupplier }}</option>
                                
                            @endforeach
                        </select>
                    </div>
    
    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"> Tambah </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="tambahsupplier" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Tambah Supplier</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('supplier.store', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namasupplier">Nama Supplier</label>
                        <input id="namasupplier" class="form-control" type="text" placeholder="masukan nama" name="namasupplier">
                    </div>
    
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="" class="form-control" placeholder="masukan alamat" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mb-3">
            <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#tambahbarang">Tambah Data Barang</button>
            <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#tambahsupplier">
                <i class="fa fa-users"></i> Tambah Supplier</button>
        </div>
        <div class="col-md-6 mb-3">
            <form action="{{ url()->current() }}">
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="cari nama" aria-label="cari nama" aria-describedby="keyword">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text" id="keyword">Cari</button>
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
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                        <th>Penjualan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $item)
                    @php
                        $total = DB::table("penjualan")->where("iddatabarang", $item->iddatabarang)->selectRaw("sum(jumlah) as total")->first()->total;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                        <td>{{ $item->namabarang }}</td>
                        <td>{{ $item->totaljumlah - $total }}</td>
                        <td>Rp{{ number_format($item->harga, 0, ",", ".") }}</td>
                        <td>
                            <button class="badge badge-btn border-0 badge-info" type="button" data-toggle="modal" data-target="#ubahstok{{ $item->iddatabarang }}">
                                <i class="fa fa-edit"></i> Stok
                            </button>

                            <button class="badge badge-btn border-0 badge-success" type="button" data-toggle="modal" data-target="#editdata{{ $item->iddatabarang }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>
                        <td>
                            <button class="badge badge-btn border-0 badge-primary" type="button" data-toggle="modal" data-target="#penjualan{{ $item->iddatabarang }}">BARANG KELUAR</button>

                        </td>


                    </tr>

                    <div id="editdata{{ $item->iddatabarang }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="my-modal-title">Edit Data</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('pembelian.update', [$item->iddatabarang]) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="namabarang">Nama Barang</label>
                                            <input id="namabarang" class="form-control" value="{{ $item->namabarang }}" type="text" name="namabarang">
                                        </div>
    
                                        <div class="form-group">
                                            <label for="harga">Harga Barang</label>
                                            <input id="harga" class="form-control" type="number" value="{{ $item->harga }}" name="harga">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="penjualan{{ $item->iddatabarang }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="my-modal-title">Barang Keluar</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('barang.keluar', []) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="number" name="iddatabarang" hidden value="{{ $item->iddatabarang }}" id="">
                                        <input type="number" name="harga" hidden value="{{ $item->harga }}" id="">
                                        <input type="number" name="jumlahsekarang" hidden value="{{ $item->totaljumlah - $total }}" id="">

                                        <div class="form-group">
                                            <label for="jumlah">Jumlah Keluar</label>
                                            <input id="jumlah" class="form-control" type="number" value="1" name="jumlah">
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggalkeluar">Tanggal Keluar</label>
                                            <input id="tanggalkeluar" class="form-control" value="{{ date('Y-m-d') }}" type="date" name="tanggalkeluar">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Proses</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                        
                    <div id="ubahstok{{ $item->iddatabarang }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="my-modal-title">Ubah Stok</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('ubah.jumlah', []) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="number" name="iddatabarang" hidden value="{{ $item->iddatabarang }}" id="">
                                        <input type="number" name="jumlahsekarang" hidden value="{{ $item->totaljumlah - $total }}" id="">
                                        <div class="form-group">
                                            <label for="j">Jumlah Saat Ini</label>
                                            <input id="j" class="form-control" type="number" readonly value="{{ $item->totaljumlah - $total }}">
                                        </div>
    
                                        <div class="form-group">
                                            <label for="jumlah">Tambah/Kurang Jumlah</label>
                                            <input id="jumlah" class="form-control" type="number" value="1" name="jumlah">
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggalmasuk">Tanggal Masuk</label>
                                            <input id="tanggalmasuk" class="form-control" value="{{ date('Y-m-d') }}" type="date" name="tanggalmasuk">
                                        </div>

                                        <div class="form-group">
                                            <label for="idsupplier">Supplier</label>
                                            <select id="idsupplier" class="form-control" name="idsupplier">
                                                @foreach ($supplier as $s)
                                                <option value="{{ $s->idsupplier }}" @if ($s->idsupplier == $item->idsupplier)
                                                    selected
                                                @endif>{{ $s->namasupplier }}</option>
                                                    
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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