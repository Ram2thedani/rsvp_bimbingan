<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div class="mb-3">
        <label for="" class="form-label">Nama</label>
        <input type="text" class="form-control" name="" value="{{ $kehadiran->Siswa->nama }}" id=""
            aria-describedby="helpId" placeholder="" readonly />
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Kelas</label>
        <input type="text" class="form-control" name="" value="{{ $kehadiran->Kelas->nama_kelas }}"
            id="" aria-describedby="helpId" placeholder="" readonly />
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Sesi</label>
        <input type="text" class="form-control" name=""
            value="{{ $kehadiran->Sesi->nama_sesi }} {{ $kehadiran->Sesi->tanggal }}" id=""
            aria-describedby="helpId" placeholder="" readonly />
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Keterangan</label>
        <input type="text" class="form-control" name="" value="{{ $kehadiran->keterangan }}" id=""
            aria-describedby="helpId" placeholder="" readonly />
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>

</body>

</html>
