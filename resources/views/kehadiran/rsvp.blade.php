<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Konfirmasi Kehadiran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0">Konfirmasi Kehadiran</h4>
                    </div>

                    <div class="card-body p-4">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                            <div>
                                <strong><i class="bi bi-info-circle"></i> Detail Sesi:</strong><br>
                                <span class="d-block mt-1">Sesi: {{ $sesi->nama_sesi }}</span>
                                <span class="d-block">Tanggal:
                                    {{ \Carbon\Carbon::parse($sesi->tanggal)->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>

                        <form action="{{ route('rsvp.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_sesi" value="{{ $sesi->id }}">
                            <input type="hidden" name="id_kelas" id="id_kelas">

                            <div class="mb-4">
                                <label for="id_siswa" class="form-label fw-bold">Nama Siswa</label>
                                <select name="id_siswa" id="id_siswa" class="form-select" required>
                                    <option value="">-- Cari Nama --</option>
                                    @foreach ($siswa as $s)
                                        <option value="{{ $s->id }}" data-kelas="{{ $s->id_kelas }}">
                                            {{ $s->nama }} - {{ $s->kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <hr class="my-4">

                            <div class="mb-3">
                                <label class="form-label fw-bold d-block">Status Kehadiran</label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hadir" id="hadir_ya"
                                        value="1" required>
                                    <label class="form-check-label" for="hadir_ya">Hadir</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hadir" id="hadir_tidak"
                                        value="0">
                                    <label class="form-check-label" for="hadir_tidak">Tidak Hadir</label>
                                </div>
                            </div>

                            <div id="keterangan-wrapper" class="mb-3" style="display:none;">
                                <label for="keterangan" class="form-label fw-bold">Alasan Tidak Hadir</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"
                                    placeholder="Tuliskan alasan izin/sakit..."></textarea>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Kirim Konfirmasi
                                </button>
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 dengan tema Bootstrap-5
            $('#id_siswa').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Cari Nama --',
                width: '100%'
            });

            // Logic set ID Kelas otomatis
            $('#id_siswa').on('change', function() {
                var selectedData = $(this).find(':selected').data('kelas');
                $('#id_kelas').val(selectedData);
            });

            // Logic Tampilkan/Sembunyikan Alasan
            $('input[name="hadir"]').on('change', function() {
                if (this.value == '1') {
                    $('#keterangan-wrapper').slideUp(); // Animasi slide
                    $('#keterangan').val('Hadir').prop('required', false);
                } else {
                    $('#keterangan-wrapper').slideDown(); // Animasi slide
                    $('#keterangan').val('').prop('required', true).focus();
                }
            });
        });
    </script>

</body>

</html>
