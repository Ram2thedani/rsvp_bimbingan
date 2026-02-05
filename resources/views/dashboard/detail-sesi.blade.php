<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Kehadiran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>📅 Detail Kehadiran Siswa</h4>
            <a href="/" class="btn btn-secondary btn-sm">
                ← Kembali
            </a>
        </div>

        <div class="mb-3">
            <strong>Tanggal Sesi:</strong> {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }}
        </div>

        @php
            $total = $siswa->count();
            $hadir = 0;
        @endphp

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama Siswa</th>
                            <th style="width:140px;">Kelas</th>
                            <th style="width:140px;">Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $i => $s)
                            @php
                                $data = $kehadiran[$s->id] ?? null;
                                $isHadir = $data && $data->hadir == 1;

                                if ($isHadir) {
                                    $hadir++;
                                }
                            @endphp
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $s->nama }}</td>
                                <td class="text-center">
                                    {{ $s->kelas->nama_kelas ?? '-' }}
                                </td>
                                <td class="text-center">
                                    @if ($isHadir)
                                        <span class="badge bg-success">Hadir</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Hadir</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $data->keterangan ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Ringkasan --}}
                <div class="mt-3">
                    <span class="badge bg-success">
                        Hadir: {{ $hadir }}
                    </span>
                    <span class="badge bg-danger">
                        Tidak Hadir: {{ $total - $hadir }}
                    </span>
                    <span class="badge bg-secondary">
                        Total Siswa: {{ $total }}
                    </span>
                </div>

            </div>
        </div>

    </div>

</body>

</html>
