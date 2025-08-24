// Script existente (modificado)
let links = document.querySelectorAll('.estudia_tab-link');
links.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        let pos = link.getAttribute('data-pos');
        document.getElementById('numcarreras').innerText = numCarreras[pos];
    });
});

// NUEVO Script para filtrado por sede (modificado)
document.addEventListener('DOMContentLoaded', function() {
    const filtroSede = document.getElementById('filtro-sede-carreras');
    
    if (filtroSede) {
        filtroSede.addEventListener('change', function() {
            const sedeSeleccionada = this.value;
            filtrarCarrerasPorSede(sedeSeleccionada);
            // Se eliminó la llamada a actualizarContadorCarreras() para que no actualice el contador
        });
    }
    
    function filtrarCarrerasPorSede(sede) {
        const panelesTabs = document.querySelectorAll('.estudia_tab-mask');
        
        panelesTabs.forEach(panel => {
            const carreras = panel.querySelectorAll('.estudia_tab-item');
            let carrerasVisibles = 0;
            
            carreras.forEach(carrera => {
                const sedesCarrera = carrera.getAttribute('data-sedes');
                
                if (sede === 'todas' || !sedesCarrera || sedesCarrera.includes(sede)) {
                    carrera.style.display = 'flex';
                    carrerasVisibles++;
                } else {
                    carrera.style.display = 'none';
                }
            });
            
            if (carrerasVisibles === 0) {
                const mensaje = panel.querySelector('.sin-carreras') || document.createElement('div');
                mensaje.className = 'sin-carreras';
                mensaje.innerHTML = '<p>No hay carreras disponibles en esta sede para esta modalidad</p>';
                if (!panel.contains(mensaje)) {
                    panel.appendChild(mensaje);
                }
            } else {
                const mensaje = panel.querySelector('.sin-carreras');
                if (mensaje) {
                    mensaje.remove();
                }
            }
        });
    }
    
    // Inicializar
    filtrarCarrerasPorSede('todas');
});