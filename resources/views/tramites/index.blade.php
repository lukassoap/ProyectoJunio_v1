<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Trámites</title>
</head>
<body>
    <h1>Mis Trámites</h1>

    <p><a href="{{ route('tramite.create') }}">Crear nuevo trámite</a> | <a href="{{ route('usuario.logout') }}">Cerrar sesión</a></p>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if($tramites->isEmpty())
        <p>No hay trámites aún.</p>
    @else
        <ul>
            @foreach($tramites as $tramite)
                <li>
                    <strong>{{ $tramite->titulo }}</strong><br>
                    {{ $tramite->descripcion }}<br>
                    <form action="{{ route('tramite.destroy', $tramite->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>