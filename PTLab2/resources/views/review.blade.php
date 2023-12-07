<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Корзина</title>
</head>
<body style="background-color:  #a28089;">
<div style="float: right; margin-right: 2%;"><a href="/">На главную</a></div>
<div style="margin-left:1%; margin-top: 20px; border-bottom: 2px solid; width: 30%;"> <h2>Товары (максимум 10 каждого типа)</h2></div>
<form method="post" action="/review/check">
    @csrf
   <div style="margin-left:2%; margin-top: 30px; "> <p style="font-family: Comic Sans MS;">Vodka</p></div>
    <div style="margin-left:1%;"> <input type="number" step="1" min="1" max="10" name="count_vodka" id="count_alcohol" class="form-control" style="width: 10%;"></div>
    <br>
    <div style="margin-left:2%;"> <p style="font-family: Comic Sans MS;">Beer</p></div>
    <div style="margin-left:1%;"> <input type="number" step="1" min="1" max="10" name="count_beer" id="count_beer" class="form-control" style="width: 10%;"></div>
    <br>
    <div style="margin-left:2%;"> <p style="font-family: Comic Sans MS;">Wine</p></div>
    <div style="margin-left:1%;"> <input type="number" step="1" min="1" max="10" name="count_wine" id="count_wine" class="form-control" style="width: 10%;"></div>
    <br>
    <div style="margin-left:2%;"> <p style="font-family: Comic Sans MS;">Whiskey</p></div>
    <div style="margin-left:1%;"> <input type="number" step="1" min="1" max="10" name="count_whiskey" id="count_whiskey" class="form-control" style="width: 10%;"></div>
    <br>
    <div style="margin-left:1%; margin-bottom:3%;"><button type="submit" class="btn btn-success">Добавить в корзину</button></div>
</form>


    <div style=' margin-left: 1%; border-bottom: 1px solid; width: 15%; margin-bottom:1%;' ><h3>Товары в корзине:</h3></div>
    <ul>
        @foreach($ContactModels as $item)
            <li class="list-group-item"><h6>{{ $item->name }} : {{ $item->count }}</h6></li>
        @endforeach
    </ul>
    @if($ContactModels->count() > 0)
    <form method="get" action="/clear">
        @csrf
        <div style="margin-left:1%;">
            <button type="submit" class="btn btn-danger">Очистить корзину</button>
            <button type="submit" class="btn btn-success">Купить</button>
        </div>
    </form>
    @else
       <div style='margin-top: 40px; margin-left: 1%; width: 15%;'><h4>Корзина пуста</h4></div>
    @endif
</body>
</html>
