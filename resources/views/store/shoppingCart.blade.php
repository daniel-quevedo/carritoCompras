@extends('layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Carrito')</title>
</head>
<body>
    <div>
        <form action="{{ route('products') }}" method="get">
            <button type="submit" class="btn btn-secondary">Volver</button>
        </form>
    </div>
    <div class="text-center">
        <h3>Mis Productos</h3>
    </div>
    @section('content')
    <div class="row justify-content-center">
        @if ($shoppingView)
            @foreach ($shoppingView as $item)
            <div class="card m-4 bg-light" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold border-bottom pb-2">{{ $item->name }}</h5>
                    <p class="card-text">{{ $item->description }}</p>
                    <p class="card-text">Total: {{ $item->stock }}</p>
                    <div class="row text-center">
                        <form action="{{ route('deleteShopping') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="idShoppingProduct" value="{{ $item->id }}" readonly>
                            <input type="hidden" name="idProduct" value="{{ $item->idProduct }}" readonly>
                            <input type="hidden" name="quantityShoppingProduct" value="{{ $item->stock }}" readonly>
                            <button type="submit" name="one" value="1" class="btn btn-warning btn-sm">eliminar uno</button>
                            <button type="submit" name="all" value="1" class="btn btn-danger btn-sm">eliminar todo</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
    @endsection
</body>
</html>