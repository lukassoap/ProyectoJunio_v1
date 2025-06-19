<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container-box {
            max-width: 1000px; margin: 40px auto;
            background: #fff; padding: 30px; border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .nav-links a, .nav-links form button { margin-right: 15px; }
        .nav-links form { display: inline; }
        .table td, .table th { vertical-align: middle; }
    </style>
</head>
<body>
  <div class="container container-box">
    <h1 class="text-center mb-4"><i class="bi bi-calendar-check-fill me-2"></i>Mis Citas</h1>

    <div class="nav-links text-center mb-4">
      <a href="{{ route('citas.create') }}" class="btn btn-outline-primary">
        <i class="bi bi-plus-circle me-1"></i>Nueva Cita
      </a>
      <a href="{{ route('tramite.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left-circle me-1"></i>Volver
      </a>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if($citas->isEmpty())
      <p class="text-center text-muted">No hay citas agendadas.</p>
    @else
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Trámite</th>
              <th>Fecha & Hora</th>
              <th>Ubicación</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($citas as $cita)
            <tr>
              <td>{{ $cita->id }}</td>
              <td>{{ $cita->tramite->titulo }}</td>
              <td>{{ $cita->fecha_hora }}</td>
              <td>{{ $cita->ubicacion }}</td>
              <td>{{ ucfirst($cita->estado) }}</td>
              <td>
                <a href="{{ route('citas.show', $cita) }}" class="btn btn-sm btn-info">
                  <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{ route('citas.edit', $cita) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-fill"></i>
                </a>
                <form action="{{ route('citas.destroy', $cita) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button onclick="return confirm('¿Eliminar esta cita?')" class="btn btn-sm btn-danger">
                    <i class="bi bi-trash-fill"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $citas->links() }}
      </div>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
