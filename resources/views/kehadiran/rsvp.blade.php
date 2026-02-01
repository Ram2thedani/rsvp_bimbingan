<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>Document</title>
</head>

<body>
    @if (session('success'))
        <div style="padding:10px; background:#d1fae5; color:#065f46; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="padding:10px; background:#fee2e2; color:#991b1b; margin-bottom:10px;">
            {{ session('error') }}
        </div>
    @endif
    <h2>Konfirmasi Kehadiran</h2>

    <div style="padding:10px; background:#f1f5f9; margin-bottom:15px;">
        <strong>Sesi:</strong> {{ $sesi->nama_sesi }} <br>
        <strong>Tanggal:</strong>
        {{ \Carbon\Carbon::parse($sesi->tanggal)->translatedFormat('d F Y') }}
    </div>

    <form action="{{ route('rsvp.store') }}" method="POST">
        @csrf

        <input type="hidden" name="id_sesi" value="{{ $sesi->id }}">

        <label>Nama Siswa</label>
        <select name="id_siswa" id="id_siswa" required style="width: 100%">
            <option value="">-- Cari Nama --</option>
            @foreach ($siswa as $s)
                <option value="{{ $s->id }}" data-kelas="{{ $s->id_kelas }}">
                    {{ $s->nama }} - {{ $s->kelas->nama_kelas }}
                </option>
            @endforeach
        </select>

        <input type="hidden" name="id_kelas" id="id_kelas">

        <hr>

        <label>Kehadiran</label><br>

        <label>
            <input type="radio" name="hadir" value="1" required>
            Hadir
        </label>

        <label>
            <input type="radio" name="hadir" value="0">
            Tidak Hadir
        </label>

        <div id="keterangan-wrapper" style="display:none; margin-top:10px;">
            <label>Alasan Tidak Hadir</label>
            <textarea name="keterangan" id="keterangan"></textarea>
        </div>

        <button type="submit">Kirim RSVP</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#id_siswa').select2();

            $('#id_siswa').on('change', function() {
                $('#id_kelas').val($(this).find(':selected').data('kelas'));
            });

            $('input[name="hadir"]').on('change', function() {
                if (this.value == '1') {
                    $('#keterangan-wrapper').hide();
                    $('#keterangan').val('Hadir').prop('required', false);
                } else {
                    $('#keterangan-wrapper').show();
                    $('#keterangan').val('').prop('required', true);
                }
            });
        });
    </script>

</body>

</html>
