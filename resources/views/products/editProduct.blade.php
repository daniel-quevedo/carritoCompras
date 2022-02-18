@extends('layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tittle','Editar Producto')</title>
</head>
<body>
    <form action="{{ route('editProduct') }}" method="post">
        @csrf
        <input type="hidden" value="{{ $productEdit[0]->id }}" name="idEditProduct" readonly>
        <h3 class="m-2 text-center">Editar Producto</h5>
        <div class="form-group">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" name="name" class="form-control" value="{{ $productEdit[0]->name }}">
        </div>
        <div class="form-group">
            <label for="description" class="form-label">Descripción:</label>
            <textarea name="description" class="form-control">{{ $productEdit[0]->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="quantity" class="form-label">Cantidad:</label>
            <input type="text" name="quantity" class="form-control" pattern="[9-0]" value="{{ $productEdit[0]->stock }}" required>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-danger">Cancelar</button>
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</body>
</html>