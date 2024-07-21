<!-- resources/views/exports/pemohons.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data Pemohon</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 10px;
            /* Ukuran teks lebih kecil */
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Data Pemohon</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Email</th>
                <th>Divisi</th>
                <th>Grup</th>
                <th>Kebutuhan</th>
                <th>Akses</th>
                <th>Koneksi Aplikasi</th>
                <th>Mulai</th>
                <th>Sampai</th>
                <th>IP Source</th>
                <th>IP Destination</th>
                <th>Port</th>
                <th>Initiate Connection</th>
                <th>Lampiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemohons as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->nik }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->divisi }}</td>
                <td>{{ $p->grup }}</td>
                <td>{{ $p->kebutuhan }}</td>
                <td>{{ $p->akses }}</td>
                <td>{{ $p->koneksiAplikasi }}</td>
                <td>{{ $p->mulai }}</td>
                <td>{{ $p->sampai }}</td>
                <td>{{ $p->ipSource }}</td>
                <td>{{ $p->ipDestination }}</td>
                <td>{{ $p->port }}</td>
                <td>{{ $p->initiateConnection }}</td>
                <td>{{ $p->lampiran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>