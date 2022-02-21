@extends('layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Productos')</title>
</head>
<body>
    @section('content')
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-light mb-4">
            <div>
                <form action="{{ route('importProducts') }}" class="d-flex" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="imports" class="form-control mx-2" type="file" accept=".xlsx" required>
                    <button class="btn btn-outline-primary" type="submit">Importar</button>
                </form>
            </div>
        </nav>
    </header>
    <div>
        <form class="justify-content-end"  action="{{ route('showShopping') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-warning position-relative">Tu Carrito <img src="shopping-cart.svg">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $shoppingView->count() }}
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
        </form>
    </div>
    <div class="text-center">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalProduct">Añadir Producto</button>
        <h1>Productos</h1>
    </div>
    <div class="row justify-content-center">
        @if ($productsView)
            @foreach ($productsView as $item)
            <div class="card m-4 bg-light" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold border-bottom pb-2">{{ $item->name }}</h5>
                    <p class="card-text">{{ $item->description }}</p>
                    <p class="card-text">Cantidades disponibles: {{ $item->stock }}</p>
                    <div class="row text-center">
                        <form class="col-6" action="{{ route('showProduct') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="idEditProduct" readonly>
                            <button type="submit" class="btn btn-primary" id="editProduct">Editar</button>
                        </form>
                        <form class="col-6" action="{{ route('deleteProduct') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="idDeleteProduct" readonly>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mb-3">
                    @if ($item->stock == 0)
                        <h4>--- Agotado ---</h3>
                    @else
                        <form action="{{ route('addShopping') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="idProduct" readonly>
                            <input type="hidden" value="{{ $item->name }}" name="nameProduct" readonly>
                            <input type="hidden" value="{{ $item->description }}" name="descriptionProduct" readonly>
                            <input type="hidden" value="{{ $item->stock }}" name="quantityProduct" readonly>
                            <button type="submit" class="btn btn-warning btn-sm">Agregar al carrito</button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
    @endsection
    {{-- =================== Mensajes ================== --}}
    @if (session('deleteShop'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('deleteShop') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('addShop'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('addShop') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('addProd'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('addProd') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('editProd'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('editProd') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('deleteProd'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('deleteProd') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
                        <input type="number" name="quantity" class="form-control" required>
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