<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Cita #{{ $cita->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container-box {
            max-width: 600px; margin: 40px auto;
            background: #fff; padding: 30px; border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        dt { font-weight: 600; }
    </style>
</head>
<body>
  <div class="container container-box">
    <h1 class="text-center mb-4"><i class="bi bi-card-checklist me-2"></i>Detalle Cita #{{ $cita->id }}</h1>

    <dl class="row">
      <dt class="col-sm-4">Trámite</dt>
      <dd class="col-sm-8">{{ $cita->tramite->titulo }}</dd>

      <dt class="col-sm-4">Fecha & Hora</dt>
      <dd class="col-sm-8">{{ $cita->fecha_hora }}</dd>

      <dt class="col-sm-4">Ubicación</dt>
      <dd class="col-sm-8">{{ $cita->ubicacion }}</dd>

      <dt class="col-sm-4">Estado</dt>
      <dd class="col-sm-8">{{ ucfirst($cita->estado) }}</dd>

      <dt class="col-sm-4">Observaciones</dt>
      <dd class="col-sm-8">{{ $cita->observaciones ?: '—' }}</dd>
    </dl>

    <div class="text-center mt-4">
      <a href="{{ route('citas.edit', $cita) }}" class="btn btn-warning me-2">
        <i class="bi bi-pencil-fill me-1"></i>Editar
      </a>
      <a href="{{ route('citas.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle me-1"></i>Volver
      </a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>