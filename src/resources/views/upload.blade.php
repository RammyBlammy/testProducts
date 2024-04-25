<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Загрузка данных</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <main class="m-3">
        <form action="{{ route('upload.index') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group w-50">
                <input type="file" class="form-control" id="inputGroupFile04" name="file">
                <button type="submit" class="btn btn-outline-secondary">Загрузить</button>
            </div>
        </form>
        <a href="/products" class="btn btn-outline-secondary mt-4">Открыть список товаров</a>
    </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>