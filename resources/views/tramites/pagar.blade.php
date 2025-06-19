<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagar Trámites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .pay-container {
            max-width: 800px;
            margin: 60px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .total-display {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .table thead {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container pay-container">
        <h2 class="text-center mb-4"><i class="bi bi-cash-stack me-2"></i>Seleccionar Trámites a Pagar</h2>

        @if($tramites->isEmpty())
            <p class="text-center text-muted">No hay trámites pendientes de pago.</p>
        @else
            <div class="table-responsive">
                <form id="pagoForm" method="GET" action="{{ route('tramite.metodo_pago_form') }}">
                    <table class="table table-bordered align-middle table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Título</th>
                                <th>Costo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tramites as $tramite)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="tramites[]" value="{{ $tramite->id }}" class="tramite-check form-check-input" data-costo="{{ $tramite->tipo->costo }}">
                                </td>
                                <td>{{ $tramite->titulo }}</td>
                                <td>${{ number_format($tramite->tipo->costo, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="total" id="total_input" value="0">
                </form>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="total-display">
                    Total: $<span id="total">0.00</span>
                </div>
                <div>
                    <a href="{{ route('tramite.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-arrow-left-circle me-1"></i>Volver al menú
                    </a>
                    <button type="submit" form="pagoForm" class="btn btn-success">
                        <i class="bi bi-credit-card-2-front-fill me-1"></i>Continuar
                    </button>
                </div>
            </div>
        @endif
    </div>

    <script>
        const checkboxes = document.querySelectorAll('.tramite-check');
        const totalEl = document.getElementById('total');
        const totalInput = document.getElementById('total_input');

        function updateTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseFloat(cb.dataset.costo);
                }
            });
            totalEl.textContent = total.toFixed(2);
            totalInput.value = total.toFixed(2);
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
