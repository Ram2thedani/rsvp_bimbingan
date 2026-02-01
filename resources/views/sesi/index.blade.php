<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{ route('sesi.create') }}">Tambah</a>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Sesi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sesi as $sesi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sesi->nama_sesi }}</td>
                    <td>{{ $sesi->tanggal }}</td>
                    <td>
                        <a href="{{ route('rsvp.create', $sesi->token) }}" target="_blank">
                            Link RSVP
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
