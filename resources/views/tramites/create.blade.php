<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Trámite</title>
</head>
<body>
    <h1>Crear Trámite</h1>

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tramite.store') }}" method="POST">
        @csrf
        <div>
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required>{{ old('descripcion') }}</textarea>
        </div>
        <button type="submit">Guardar</button>
    </form>

    <p><a href="{{ route('tramite.index') }}">Volver a lista</a></p>
</body>
</html>
