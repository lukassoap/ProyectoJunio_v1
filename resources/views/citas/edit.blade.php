<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita #{{ $cita->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container-box {
            max-width: 600px; margin: 40px auto;
            background: #fff; padding: 30px; border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
  <div class="container container-box">
    <h1 class="text-center mb-4">
      <i class="bi bi-pencil-square me-2"></i>Editar Cita #{{ $cita->id }}
    </h1>

    <form action="{{ route('citas.update', $cita) }}" method="POST">
      @csrf @method('PUT')

      <div class="mb-3">
        <label class="form-label">Trámite</label>
        <select name="tramite_id" class="form-select @error('tramite_id') is-invalid @enderror">
          <option value="">— Selecciona —</option>
          @foreach($tramites as $t)
            <option value="{{ $t->id }}"
              {{ old('tramite_id', $cita->tramite_id)==$t->id?'selected':'' }}>
              {{ $t->titulo }}
            </option>
          @endforeach
        </select>
        @error('tramite_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Fecha y hora</label>
        <input type="datetime-local" name="fecha_hora"
               class="form-control @error('fecha_hora') is-invalid @enderror"
               value="{{ old('fecha_hora', str_replace(' ', 'T', $cita->fecha_hora)) }}">
        @error('fecha_hora')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Ubicación / Link</label>
        <input type="text" name="ubicacion"
               class="form-control @error('ubicacion') is-invalid @enderror"
               value="{{ old('ubicacion', $cita->ubicacion) }}">
        @error('ubicacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select @error('estado') is-invalid @enderror">
          @foreach(['pendiente','confirmada','cancelada'] as $e)
            <option value="{{ $e }}"
              {{ old('estado', $cita->estado)==$e?'selected':'' }}>
              {{ ucfirst($e) }}
            </option>
          @endforeach
        </select>
        @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Observaciones</label>
        <textarea name="observaciones" rows="3"
                  class="form-control @error('observaciones') is-invalid @enderror">{{ old('observaciones', $cita->observaciones) }}</textarea>
        @error('observaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="d-flex justify-content-between">
        <button class="btn btn-warning"><i class="bi bi-save2-fill me-1"></i>Actualizar</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">
          <i class="bi bi-x-circle-fill me-1"></i>Cancelar
        </a>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>