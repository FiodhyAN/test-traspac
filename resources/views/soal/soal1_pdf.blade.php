<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pegawai</title>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            font-size: 10px;
        }

        th {
            background-color: #233b64;
            color: white;
            font-size: 12px;
        }

        h1,
        h3 {
            text-align: center;
        }
    </style>

</head>

<body>

    <h1>Daftar Pegawai</h1>
    <h3>Nama Lembaga/Instansi</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Alamat</th>
                <th>Tgl Lahir</th>
                <th>L/P</th>
                <th>Gol</th>
                <th>Eselon</th>
                <th>Jabatan</th>
                <th>Tempat Tugas</th>
                <th>Agama</th>
                <th>Unit Kerja</th>
                <th>No. HP</th>
                <th>NPWP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawais as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->tempat_lahir }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ date('d-m-Y', strtotime($p->tanggal_lahir)) }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->golongan }}</td>
                    <td>{{ $p->eselon }}</td>
                    <td>{{ $p->jabatan }}</td>
                    <td>{{ $p->tempat_tugas }}</td>
                    <td>{{ $p->agama }}</td>
                    <td>{{ $p->unit->nama }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->npwp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
