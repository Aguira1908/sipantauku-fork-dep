<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penerimaan</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #1b5e20;
        }

        .info {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .info p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
        }

        th {
            background-color: #2e7d32;
            color: white;
            text-align: center;
        }

        td {
            text-align: left;
        }

        td.nominal {
            text-align: right;
        }

        .badge-pkb {
            background: #d1fae5;
            color: #065f46;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-samsat {
            background: #dbeafe;
            color: #1d4ed8;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-default {
            background: #ecfdf5;
            color: #047857;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: bold;
        }

        .total {
            margin-top: 15px;
            text-align: right;
            font-weight: bold;
            font-size: 16px;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
        }

        .ttd {
            width: 250px;
            text-align: center;
            float: right;
        }

        .clear {
            clear: both;
        }

    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <h2>
            LAPORAN PENERIMAAN PAJAK
        </h2>

        <p>
            Instansi Pajak
        </p>

    </div>

    <!-- INFO -->
    <div class="info">

        <p>
            <b>Periode:</b>
            {{ request('dari') ?? '-' }}
            s/d
            {{ request('sampai') ?? '-' }}
        </p>

        <p>
            <b>Bagian:</b>

            {{ request('bagian_id')
                ? $data->first()?->bagian->nama_bagian
                : 'Semua Bagian'
            }}
        </p>

        <p>
            <b>Tanggal Cetak:</b>
            {{ date('d-m-Y') }}
        </p>

    </div>

    <!-- TABLE -->
    <table>

        <thead>

            <tr>
                <th width="15%">Tanggal</th>
                <th width="25%">Bagian</th>
                <th width="35%">Keterangan</th>
                <th width="25%">Jumlah (Rp)</th>
            </tr>

        </thead>

        <tbody>

            @forelse($data as $d)

            <tr>

                <!-- TANGGAL -->
                <td>
                    {{ date('d-m-Y', strtotime($d->tanggal)) }}
                </td>

                <!-- BAGIAN -->
                <td>

                    @php
                        $namaBagian = $d->bagian->nama_bagian;
                    @endphp

                    {{-- KHUSUS PKB --}}
                    @if($namaBagian == 'PKB')

                        {{-- E-SAMSAT --}}
                        @if($d->jenis_input == 'E-Samsat')

                            <span class="badge-samsat">
                                 E-Samsat (PKB)
                            </span>

                        {{-- PKB --}}
                        @else

                            <span class="badge-pkb">
                                 PKB
                            </span>

                        @endif

                    {{-- BAGIAN LAIN --}}
                    @else

                        <span class="badge-default">
                             {{ $namaBagian }}
                        </span>

                    @endif

                </td>

                <!-- KETERANGAN -->
                <td>
                    {{ $d->keterangan ?? '-' }}
                </td>

                <!-- JUMLAH -->
                <td class="nominal">
                    {{ number_format($d->jumlah_uang, 0, ',', '.') }}
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4" style="text-align:center;">
                    Tidak ada data
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

    <!-- TOTAL -->
    <div class="total">

        Total Penerimaan:
        Rp {{ number_format($total, 0, ',', '.') }}

    </div>

    <!-- TANDA TANGAN -->
    <div class="footer">

        <div class="ttd">

            <p>
                Mengetahui,
            </p>

            <br><br><br>

            <p>
                <b></b>
            </p>

        </div>

    </div>

    <div class="clear"></div>

</div>

</body>
</html>
