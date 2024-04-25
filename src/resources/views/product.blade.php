<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$product['name']}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <main class="m-3 mt-0">
        @php
        $images = explode(", ", $product['links_image']);
        @endphp
        <div class="row">
            <div class="col-7">
                <ul class="list-group list-group-flush">
                    @foreach ($product as $key=>$attribute)
                    <li class="list-group-item list-group-item-action">{{$key}}: {{$attribute}}</li>
                    @endforeach
                </ul>
                <ul class="list-group list-group-flush">
                    @foreach ($imagesInfo as $im)
                    <li class="list-group-item list-group-item-action">{{$im['img_link']}} -> {{$im['path']}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-5">
                <div id="carouselExampleControls" class="carousel carousel-dark slide w-100" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($images as $link)
                        <div class="carousel-item @if ($link  == $images[0]) active @endif">
                            <img src="{{$link}}" class="d-block w-100 h-50" alt="...">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>


    </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>