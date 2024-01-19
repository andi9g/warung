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
                <h2>LAPORAN BARANG KELUAR</h2>
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
            <th>Tanggal Masuk</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total Harga</th>
        </tr>

        @php
            $totalkeseluruhan = 0;
        @endphp
        @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggalmasuk)->isoFormat("DD MMMM Y") }}</td>
                <td>
                    {{ $item->namabarang }}
                </td>
                <td>
                    {{ $item->total }}
                </td>
                <td>
                    Rp{{ number_format($item->harga, 0, ",", ".") }}
                </td>
                <td>
                    Rp{{ number_format($item->total * $item->harga,0, ",", ".") }}
                    @php
                        $totalkeseluruhan = $totalkeseluruhan + ($item->total * $item->harga);
                    @endphp
                </td>
            </tr>
        @endforeach

        <tr>
            <th colspan="5">Total Harga Keseluruhan</th>
            <th>Rp{{ number_format($totalkeseluruhan, 0, ",", ".") }}</th>
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