<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagar Trámites</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
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
        .total {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
        .actions {
            text-align: center;
            margin-top: 10px;
        }
        .actions button,
        .actions a {
            margin: 0 5px;
            padding: 6px 12px;
            border: 1px solid #999;
            background: #f0f0f0;
            text-decoration: none;
            color: #000;
            cursor: pointer;
        }
        .actions a {
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>Seleccionar Trámites a Pagar</h1>

    @if($tramites->isEmpty())
        <p style="text-align:center;">No hay trámites pendientes de pago.</p>
    @else
        <table>
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
                        <td>
                            <input type="checkbox" class="tramite-check" data-costo="{{ $tramite->tipo->costo }}">
                        </td>
                        <td>{{ $tramite->titulo }}</td>
                        <td>${{ number_format($tramite->tipo->costo, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                Total: $<span id="total">0.00</span>
            </div>
            <div class="actions">
                <a href="{{ route('tramite.index') }}">Volver al menú</a>
                <button type="button">Continuar</button>
            </div>
    @endif

    <script>
        const checkboxes = document.querySelectorAll('.tramite-check');
        const totalEl = document.getElementById('total');

        function updateTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseFloat(cb.dataset.costo);
                }
            });
            totalEl.textContent = total.toFixed(2);
        }

        checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
    </script>
</body>
</html>