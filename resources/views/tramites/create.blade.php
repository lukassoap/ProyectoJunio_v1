<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Trámite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Crear Trámite</h2>

        <form action="{{ route('tramite.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" required>{{ old('descripcion') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="t_tipo_id" class="form-label">Tipo de Trámite</label>
                <select name="t_tipo_id" class="form-select" required>
                    <option value="">-- Selecciona un tipo --</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('t_tipo_id') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            

            <button type="submit" class="btn btn-primary">Guardar Trámite</button>
        </form>
    </div>
</body>
</html>