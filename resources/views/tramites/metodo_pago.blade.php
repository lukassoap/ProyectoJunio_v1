<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Método de Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Método de Pago</h2>
    <form action="{{ route('tramite.procesar_metodo_pago') }}" method="POST">
        @csrf
        @foreach($tramites as $tramite)
            <input type="hidden" name="tramites[]" value="{{ $tramite->id }}">
        @endforeach
        @if($metodos->isNotEmpty())
            <h5 class="mt-3">Métodos guardados</h5>
            <div class="mb-3">
                <div class="form-check">
                    <input type="radio" name="metodo_guardado" id="metodo_nuevo" class="form-check-input metodo-guardado" checked>
                    <label for="metodo_nuevo" class="form-check-label">Nuevo método</label>
                </div>
                @foreach($metodos as $m)
                    <div class="form-check">
                        <input type="radio" name="metodo_guardado" id="metodo{{ $m->id }}" class="form-check-input metodo-guardado"
                            data-id="{{ $m->id }}"
                            data-numero="{{ $m->numero }}"
                            data-titular="{{ $m->titular }}"
                            data-fecha="{{ $m->fecha_expiracion->format('Y-m-d') }}"
                            data-cvv="{{ $m->cvv }}"
                            data-tipo="{{ $m->tipo }}">
                        <label for="metodo{{ $m->id }}" class="form-check-label">
                            {{ ucfirst($m->tipo) }} ****{{ substr($m->numero, -4) }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endif
        <input type="hidden" name="metodo_pago_id" id="metodo_pago_id">
        <div class="mb-3">
            <label class="form-label">Número de tarjeta</label>
            <input type="text" name="numero" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre del titular</label>
            <input type="text" name="titular" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de expiración</label>
            <input type="date" name="fecha_expiracion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">CVV</label>
            <input type="text" name="cvv" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
            <input type="radio" name="tipo" value="debito" id="debito" class="form-check-input" checked>
            <label for="debito" class="form-check-label">Débito</label>
        </div>
        <div class="mb-3 form-check">
            <input type="radio" name="tipo" value="credito" id="credito" class="form-check-input">
            <label for="credito" class="form-check-label">Crédito</label>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="guardar" id="guardar" class="form-check-input">
            <label for="guardar" class="form-check-label">Guardar método de pago</label>
        </div>
        <p>Total a pagar: ${{ number_format($total, 2) }}</p>
        <button type="submit" class="btn btn-primary">Pagar</button>
    </form>
    <script>
        const radios = document.querySelectorAll('.metodo-guardado');
        const numero = document.querySelector('input[name="numero"]');
        const titular = document.querySelector('input[name="titular"]');
        const fecha = document.querySelector('input[name="fecha_expiracion"]');
        const cvv = document.querySelector('input[name="cvv"]');
        const debito = document.getElementById('debito');
        const credito = document.getElementById('credito');
        const metodoId = document.getElementById('metodo_pago_id');

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.dataset.id) {
                    metodoId.value = radio.dataset.id;
                    numero.value = radio.dataset.numero;
                    titular.value = radio.dataset.titular;
                    fecha.value = radio.dataset.fecha;
                    cvv.value = radio.dataset.cvv;
                    if (radio.dataset.tipo === 'debito') {
                        debito.checked = true;
                    } else {
                        credito.checked = true;
                    }
                } else {
                    metodoId.value = '';
                    numero.value = '';
                    titular.value = '';
                    fecha.value = '';
                    cvv.value = '';
                }
            });
        });
    </script>
</div>
</body>
</html>