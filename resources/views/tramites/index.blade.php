<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Trámites</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        .nav-links {
            text-align: center;
            margin-bottom: 20px;
        }
        .nav-links a {
            margin: 0 15px;
            text-decoration: none;
            color: #007bff;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            border: 1px solid #999;
            padding: 10px;
        }
        .success {
            text-align: center;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Mis Trámites</h1>

    <div class="nav-links">
        <a href="{{ route('tramite.create') }}">Crear nuevo trámite</a>
        <a href="{{ route('usuario.edit') }}">Actualizar usuario</a>
        <a href="{{ route('tramite.pagar') }}">Pagar trámite</a>
        <form action="{{ route('usuario.logout') }}" method="POST" style="display:inline">
            @csrf
            <button type="submit" style="background:none;border:none;padding:0;color:#007bff;cursor:pointer">Cerrar sesión</button>
        </form>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($tramites->isEmpty())
        <p style="text-align:center;">No hay trámites aún.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tramites as $tramite)
                <tr>
                    <td>{{ $tramite->titulo }}</td>
                    <td>{{ $tramite->descripcion }}</td>
                    <td>
                        <form action="{{ route('tramite.destroy', $tramite->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
