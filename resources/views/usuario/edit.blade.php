<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .edit-container {
            max-width: 500px;
            margin: 80px auto;
            padding: 30px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        input.form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
            border-color: #198754;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="edit-container">
            <h2 class="text-center mb-4"><i class="bi bi-pencil-square me-2"></i>Actualizar Datos</h2>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
                <div class="text-center mb-3">
                    <a href="{{ route('tramite.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Volver al menú
                    </a>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuario.update') }}" method="POST">
                @csrf

                <h5 class="text-muted mb-3"><i class="bi bi-person-fill me-2"></i>Datos personales</h5>

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->nombre) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $user->telefono) }}">
                    </div>
                </div>

                <h5 class="text-muted mt-4 mb-3"><i class="bi bi-lock-fill me-2"></i>Cambiar contraseña</h5>

                <div class="mb-3">
                    <label for="password" class="form-label">Nueva contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success" id="submitBtn">
                        <i class="bi bi-save-fill me-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS para alertas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Spinner en el botón -->
    <script>
        const form = document.querySelector("form");
        const button = document.getElementById("submitBtn");

        form.addEventListener("submit", () => {
            button.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Guardando...`;
            button.disabled = true;
        });
    </script>
</body>
</html>