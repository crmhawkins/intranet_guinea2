<div class="container" style="width: 100%; height: 100%">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <iframe src="/laravel-filemanager" style="width: max-content; height: max-content; overflow: hidden; border: none;"></iframe>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @php
                $previousUrl = session('previous_url') ?? url()->previous();
                $previousPath = parse_url($previousUrl, PHP_URL_PATH);
                $isAdminRoute = Str::startsWith($previousPath, '/admin');
            @endphp

            @if (!$isAdminRoute)
                @mobile
                    $('body').removeClass('enlarged');
                @endmobile
            @endif
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register("{{ asset('service-worker.js') }}")
                    .then(function(registration) {
                        console.log('Service Worker registrado con éxito con el alcance:', registration.scope);
                    })
                    .catch(function(error) {
                        console.log('Registro de Service Worker fallido:', error);
                    });
            }
            let deferredPrompt;
            const addBtn = document.querySelector(
                '.add-button'); // Asegúrate de tener un botón con la clase 'add-button' en tu HTML
            addBtn.style.display = 'none';

            window.addEventListener('beforeinstallprompt', (e) => {
                // Evita que Chrome muestre el prompt por defecto
                e.preventDefault();
                deferredPrompt = e;
                // Muestra el botón
                addBtn.style.display = 'block';

                addBtn.addEventListener('click', (e) => {
                    // Oculta el botón, ya que no será necesario
                    addBtn.style.display = 'none';
                    // Muestra el prompt
                    deferredPrompt.prompt();
                    // Espera a que el usuario responda al prompt
                    deferredPrompt.userChoice.then((choiceResult) => {
                        if (choiceResult.outcome === 'accepted') {
                            console.log('El usuario aceptó añadir a pantalla de inicio');
                        } else {
                            console.log('El usuario rechazó añadir a pantalla de inicio');
                        }
                        deferredPrompt = null;
                    });
                });
            });
            // Suponiendo que las alertas sin leer están en una variable de JavaScript `alertas`
            let alertas = @json($alertas);
            let promiseChain = Promise.resolve();

            alertas.forEach((alerta) => {
                promiseChain = promiseChain.then(() => {
                    switch (alerta.tipo) {
                        case 1:
                            return Swal.fire({
                                title: alerta.titulo,
                                text: alerta.descripcion,
                                type: 'info',
                                confirmButtonText: 'Entendido',
                                willClose: () => {
                                    // Marcar la alerta como leída usando Livewire o una solicitud AJAX
                                    @this.call('marcarComoLeida', alerta.id);
                                }
                            });
                            break;
                        case 2:
                            return Swal.fire({
                                title: alerta.titulo,
                                text: alerta.descripcion +
                                    "<br> Esta alerta contiene un enlace.",
                                type: 'info',
                                confirmButtonText: 'Entendido',
                                willClose: () => {
                                    // Marcar la alerta como leída usando Livewire o una solicitud AJAX
                                    @this.call('marcarComoLeida', alerta.id);
                                }
                            });
                            break;
                        case 3:
                            return Swal.fire({
                                title: alerta.titulo,
                                text: alerta.descripcion +
                                    "<br> Esta alerta contiene una imagen.",
                                type: 'info',
                                confirmButtonText: 'Entendido',
                                willClose: () => {
                                    // Marcar la alerta como leída usando Livewire o una solicitud AJAX
                                    @this.call('marcarComoLeida', alerta.id);
                                }
                            });
                            break;
                        case 4:
                            return Swal.fire({
                                title: alerta.titulo,
                                text: alerta.descripcion +
                                    "<br> Esta alerta contiene un archivo enlazado.",
                                type: 'info',
                                confirmButtonText: 'Entendido',
                                willClose: () => {
                                    // Marcar la alerta como leída usando Livewire o una solicitud AJAX
                                    @this.call('marcarComoLeida', alerta.id);
                                }
                            });
                            break;
                        default:
                            break;
                    }

                });
            });
        });
    </script>
</div>
