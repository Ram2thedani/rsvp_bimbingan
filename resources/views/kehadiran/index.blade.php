<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="GET">
        <label>Tanggal Sesi:</label>
        <select name="tanggal" required>
            <option value="">-- Pilih Tanggal Sesi --</option>
            @foreach ($sesiList as $sesi)
                <option value="{{ $sesi->tanggal }}" {{ $tanggal == $sesi->tanggal ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }}
                </option>
            @endforeach
        </select>

        <button type="submit">Filter</button>
    </form>


    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Hadir</th>
                <th>Tanggal Sesi</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $s)
                @php
                    $hadir = $s->kehadiran->first()->hadir ?? 0;
                    $kehadiranId = $s->kehadiran->first()->id ?? null;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->kelas->nama_kelas }}</td>

                    <td>
                        <form action="{{ route('kehadiran.storeOrUpdate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_siswa" value="{{ $s->id }}">
                            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                            <input type="checkbox" name="hadir" value="1" {{ $hadir ? 'checked' : '' }}
                                onchange="this.form.submit()">
                        </form>
                    </td>

                    <td>{{ $tanggal }}</td>

                </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>
