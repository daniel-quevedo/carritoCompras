@extends('layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title','Registrarse')</title>
</head>
<body>
@section('content')

<div class="bg-light col-5 mx-auto">
    <h1 class="text-center">Registrarse</h1>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="form-group mb-4 mx-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group mb-4 mx-3">
            <label for="email" class="form-label">Correo:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group mb-4 mx-3">
            <label for="password" class="form-label">Contaseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary mb-4">Registrarse</button>
        </div>
    </form>
</div>

@endsection
</body>
</html>