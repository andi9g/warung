<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Masuk</title>
    <style>
        h1 {
            margin: 0;
            padding: 0;
        }
        h2 {
            margin: 0;
            padding: 0;
        }
        h3 {
            margin: 0;
            padding: 0;
        }
        h4 {
            margin: 0;
            padding: 0;
        }
        p {
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                <h1>
                    WARUNG DENO
                </h1>
                <h2>LAPORAN BARANG MASUK</h2>
                <P>
                    {{ \Carbon\Carbon::parse($tanggalawal)->isoFormat("DD MMMM Y") }}   
                     s.d  
                    {{ \Carbon\Carbon::parse($tanggalakhir)->isoFormat("DD MMMM Y") }}    
                </P>
            </td>
        </tr>
    </table>

    <br>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Tgl Masuk</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total Harga</th>
            <th>Supplier</th>
        </tr>

        @php
            $totalkeseluruhan = 0;
        @endphp
        @foreach ($data as $item)
            @php
                // $keluar = DB::table("penjualan")->selectRaw("sum(jumlah) as total")->first()->total;
                
                $jml = $item->total;
            @endphp

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggalmasuk)->isoFormat("DD MMM Y") }}</td>
                <td>
                    {{ $item->namabarang }}
                </td>
                <td>
                    {{ $jml }}
                </td>
                <td>
                    Rp{{ number_format($item->harga, 0, ",", ".") }}
                </td>
                <td>
                    Rp{{ number_format($jml * $item->harga,0, ",", ".") }}
                    @php
                        $totalkeseluruhan = $totalkeseluruhan + ($jml * $item->harga);
                    @endphp
                </td>
                <td align="left" valign="top">
                    @php
                        $supplier = App\Models\pembelianM::from("pembelian as p")
                        ->join("databarang as b", "b.iddatabarang", "p.iddatabarang")
                        ->join("supplier as s", "s.idsupplier", "p.idsupplier")
                        ->where("b.namabarang", $item->namabarang)
                        ->select("s.namasupplier")
                        ->groupBy("s.namasupplier")
                        ->get();
                    @endphp
                        @foreach ($supplier as $sup)
                            {{ $sup->namasupplier }} <br>
                        @endforeach
                </td>
            </tr>
        @endforeach

        <tr>
            <th colspan="5">Total Harga Keseluruhan</th>
            <th colspan="2">Rp{{ number_format($totalkeseluruhan, 0, ",", ".") }}</th>
        </tr>
    </table>

    <table>
        <tr>
            <td width="60%"></td>
            <td align="center">
                <br>
                <p> {{ \Carbon\Carbon::parse(date('Y-m-d'))->isoFormat("DD MMMM Y") }}</p>
                <br>
                <br>
                <br>
                <p>ADMIN</p>
            </td>
        </tr>
    </table>


</body>
</html>