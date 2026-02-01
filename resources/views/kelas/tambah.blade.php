<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('kelas.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" class="form-control" name="nama_kelas" id="" aria-describedby="helpId"
                placeholder="" />
        </div>
        <button type="submit">
            Simpan
        </button>
    </form>
</body>

</html>
