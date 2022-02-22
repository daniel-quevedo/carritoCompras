@extends('layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title','Inicio Sesión')</title>
</head>
<body>
@section('content')
    <div class="bg-light col-5 mx-auto">
        <h1 class="text-center">Login</h1>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group mb-4 mx-3">
                <label for="email" class="form-label">Correo:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group mb-4 mx-3">
                <label for="password" class="form-label">Contaseña:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary mb-4">Iniciar Sesión</button>
            </div>
        </form>
        <div class="form-group text-end">
            <a class="link-primary m-4" href="{{ route('viewRegister') }}">Registrarse</a>
        </div>
    </div>
@endsection
@if (session('registerUsu'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('registerUsu') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
</body>
</html>