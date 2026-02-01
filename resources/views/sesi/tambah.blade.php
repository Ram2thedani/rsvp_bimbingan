<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('sesi.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama_sesi" id="" aria-describedby="helpId"
                placeholder="" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" id="" aria-describedby="helpId"
                placeholder="" />
        </div>
        <button type="submit">
            Simpan
        </button>
    </form>
</body>

</html>
