<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Данные из БД</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <main class="m-3 mt-0">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    @foreach ($cols as $col)
                    <th scope="col">{{$col}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                @php
                $id = $product['id'];
                $route = route("product.showDetails", $id);
                @endphp
                <tr data-id="{{$id}}" style="cursor: pointer;" onclick="window.location.href='{{ $route }}'">
                    @foreach ($product as $attrs)
                    <td scope="row">{{$attrs}}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>