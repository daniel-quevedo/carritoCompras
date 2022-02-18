@extends('layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('tittle', 'productos')</title>
</head>
<body>
    @section('content')
    <div class="text-center">
        <div class="text-center">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalProduct">Añadir Producto</button>
        </div>
        <h1>Productos</h1>
    </div>
    <div class="row justify-content-center">
        @if ($productsView)
            @foreach ($productsView as $item)
            <div class="card m-4 bg-light" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold border-bottom pb-2">{{ $item->name }}</h5>
                    <p class="card-text">{{ $item->description }}</p>
                    <div class="row">
                        <form class="col-6" action="{{ route('showProduct') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="idEditProduct" readonly>
                            <button class="btn btn-primary" id="editProduct">Editar</button>
                        </form>
                        <form class="col-6" action="{{ route('deleteProduct') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="idDeleteProduct" readonly>
                            <button class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
    @endsection
</body>

{{-- ========= Modal Añadir Producto =========== --}}
<div class="modal fade" id="modalProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('addProduct') }}" method="post">
                @csrf
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Descripción:</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="form-label">Cantidad:</label>
                        <input type="text" name="quantity" class="form-control" pattern="[9-0]" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
            </form>
        </div>
    </div>
</div>


</html>