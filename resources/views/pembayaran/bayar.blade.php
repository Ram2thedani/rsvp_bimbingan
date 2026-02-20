<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Hardcover</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h3 class="mb-4">Pembayaran Hardcover</h3>

        <div class="card">
            <div class="card-body">

                <h5>Nama Siswa: {{ $siswa->nama }}</h5>
                <p>Total Tagihan: Rp {{ number_format(35000, 0, ',', '.') }}</p>
                <p>Sudah Bayar: Rp {{ number_format($totalBayar, 0, ',', '.') }}</p>
                <p>Sisa:
                    <strong>
                        Rp {{ number_format($sisa, 0, ',', '.') }}
                    </strong>
                </p>

                @if ($sisa <= 0)
                    <div class="alert alert-success">
                        Siswa sudah lunas.
                    </div>
                @else
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">

                        <div class="mb-3">
                            <label class="form-label">Nominal Bayar</label>
                            <input type="text" id="nominal_display" class="form-control"
                                placeholder="Masukkan nominal" required>

                            <input type="hidden" name="nominal_bayar" id="nominal_real">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Bayar</label>
                            <input type="date" name="tanggal_bayar" class="form-control" value="{{ date('Y-m-d') }}"
                                required>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Simpan Pembayaran
                        </button>

                        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </form>

                @endif

            </div>
        </div>
    </div>
    <script>
        const displayInput = document.getElementById('nominal_display');
        const realInput = document.getElementById('nominal_real');

        displayInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');

            realInput.value = value;

            this.value = new Intl.NumberFormat('id-ID').format(value);
        });
    </script>
</body>

</html>
