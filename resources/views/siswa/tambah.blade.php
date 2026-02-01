<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('siswa.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="" aria-describedby="helpId"
                placeholder="" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Kelas</label>
            <select name="id_kelas" id="">
                @foreach ($kelas as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>

        </div>
        <button type="submit">
            Simpan
        </button>
    </form>
</body>

</html>
