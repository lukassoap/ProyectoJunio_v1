<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Trámites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .nav-links a, .nav-links form button {
            margin-right: 15px;
        }
        .nav-links form {
            display: inline;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <div class="container table-container">
        <h1 class="text-center mb-4"><i class="bi bi-folder2-open me-2"></i>Mis Trámites</h1>

        <div class="nav-links text-center mb-4">
            <a href="{{ route('tramite.create') }}" class="btn btn-outline-primary">
                <i class="bi bi-file-earmark-plus-fill me-1"></i>Crear nuevo trámite
            </a>
            <a href="{{ route('tramite.pagar') }}" class="btn btn-outline-success">
                <i class="bi bi-cash-coin me-1"></i>Pagar trámite
            </a>
            <!-- Nuevo botón para ir a la sección de Citas -->
            <a href="{{ route('citas.index') }}" class="btn btn-outline-info">
                <i class="bi bi-calendar-event me-1"></i>Mis Citas
            </a>
            <a href="{{ route('usuario.edit') }}" class="btn btn-outline-secondary">
                <i class="bi bi-person-lines-fill me-1"></i>Actualizar usuario
            </a>
            <form action="{{ route('usuario.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-1"></i>Cerrar sesión
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if($tramites->isEmpty())
            <p class="text-center text-muted">No hay trámites aún.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tramites as $tramite)
                        <tr>
                            <td>{{ $tramite->titulo }}</td>
                            <td>{{ $tramite->descripcion }}</td>
                            <td>
                                <form action="{{ route('tramite.destroy', $tramite->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Deseas eliminar este trámite?')">
                                        <i class="bi bi-trash-fill"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
