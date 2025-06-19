<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Trámite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        input:focus, textarea:focus, select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4"><i class="bi bi-folder-plus me-2"></i>Crear Trámite</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tramite.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-file-earmark-text-fill"></i></span>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion') }}</textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="t_tipo_id" class="form-label">Tipo de Trámite</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                        <select name="t_tipo_id" id="t_tipo_id" class="form-select" required>
                            <option value="">-- Selecciona un tipo --</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('t_tipo_id') == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="bi bi-save2-fill me-1"></i> Guardar Trámite
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Spinner al enviar -->
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