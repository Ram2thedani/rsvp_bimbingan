<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran Hardcover</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h3 class="mb-4">Data Pembayaran Hardcover (Rp 35.000)</h3>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                {{-- <th>Total Tagihan</th> --}}
                                <th>Sudah Bayar</th>
                                <th>Sisa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr class="text-center align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-start">{{ $item['nama'] }}</td>
                                    {{-- <td>Rp {{ number_format($item['total_tagihan'], 0, ',', '.') }}</td> --}}
                                    <td>Rp {{ number_format($item['total_bayar'], 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item['sisa'], 0, ',', '.') }}</td>
                                    <td>
                                        @if ($item['status'] === 'Lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item['status'] === 'Lunas')
                                            <button class="btn btn-sm btn-secondary" disabled>
                                                Lunas
                                            </button>
                                        @else
                                            <a href="{{ route('pembayaran.bayar', $item['id']) }}"
                                                class="btn btn-sm btn-primary">
                                                Bayar
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Tidak ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
