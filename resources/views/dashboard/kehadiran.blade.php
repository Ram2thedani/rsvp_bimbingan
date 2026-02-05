<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Kehadiran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">

        <h3 class="mb-4">📊 Dashboard Kehadiran Siswa</h3>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Tanggal Sesi</th>
                            <th style="width: 180px;">Jumlah Hadir</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sesiList as $i => $sesi)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($sesi->tanggal)->format('d M Y') }} -
                                    {{ $sesi->nama_sesi }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success fs-6">
                                        {{ $sesi->jumlah_hadir }}

                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('dashboard.kehadiran.detail', $sesi) }}"
                                        class="btn btn-sm btn-primary">
                                        Lihat Siswa
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada data sesi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</body>

</html>
