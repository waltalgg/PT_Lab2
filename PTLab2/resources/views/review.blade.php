<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post" action="/review/check">
    @csrf
    <p>Vodka</p>
    <input type="number" step="1" min="1" max="10" name="count_vodka" id="count_alcohol" class="form-control" style="width: 10%;">
    <br>
    <p>Beer</p>
    <input type="number" step="1" min="1" max="10" name="count_beer" id="count_beer" class="form-control" style="width: 10%;">
    <br>
    <p>Wine</p>
    <input type="number" step="1" min="1" max="10" name="count_wine" id="count_wine" class="form-control" style="width: 10%;">
    <br>
    <p>Whiskey</p>
    <input type="number" step="1" min="1" max="10" name="count_whiskey" id="count_whiskey" class="form-control" style="width: 10%;">
    <br>
    <button type="submit" class="btn btn-success">Добавить в корзину</button>
</form>


    <div style='margin-top: 40px;'><h3>Товары в корзине:</h3></div>
    <ul>
        @foreach($ContactModels as $item)
            <li class="list-group-item">{{ $item->name }} : {{ $item->count }}</li>
        @endforeach
    </ul>
    @if($ContactModels->count() > 0)
    <form method="get" action="/clear">
        @csrf
        <button type="submit" class="btn btn-danger">Очистить корзину</button>
        <button type="submit" class="btn btn-success">Купить</button>
    </form>
    @else
        <p>Корзина пуста</p>
    @endif
</body>
</html>
