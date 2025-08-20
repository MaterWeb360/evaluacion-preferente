document.addEventListener('DOMContentLoaded', () => {
    function filters(radioName, horarioId, carreraId, codigoHiddenId) {
        const radioButtons = document.querySelectorAll(`input.${radioName}[type="radio"]`);
        const horarioSelect = document.getElementById(horarioId);
        const carreraSelect = document.getElementById(carreraId);
        const codigoHiddenInput = document.getElementById(codigoHiddenId);

        const hiddenOptionsContainer = document.getElementById('modulos_horarios');
        const hiddenOptionsContainerC = document.getElementById('modulos_carreras');

        const updateCodigoHiddenInput = () => {
            const selectedRadio = document.querySelector(`input.${radioName}[type="radio"]:checked`);
            if (selectedRadio) {
                codigoHiddenInput.value = selectedRadio.dataset.cod || '';
            } else {
                codigoHiddenInput.value = '';
            }
        };

        const updateHorarioSelect = () => {
            const selectedRadio = document.querySelector(`input.${radioName}[type="radio"]:checked`);
            horarioSelect.innerHTML = ''; // Limpiar el select
            if (selectedRadio) {
                const modulo = selectedRadio.dataset.modulo; // Obtener el módulo del radio seleccionado

                // Filtrar las opciones que coincidan con el módulo seleccionado
                const opcionesFiltradas = Array.from(hiddenOptionsContainer.querySelectorAll('option'))
                    .filter(option => option.dataset.modulo === modulo);

                if (opcionesFiltradas.length > 0) {
                    opcionesFiltradas.forEach(option => {
                        // Clonar la opción directamente sin modificar sus atributos
                        const nuevaOpcion = option.cloneNode(true);
                        horarioSelect.appendChild(nuevaOpcion);
                    });

                    // Comprobar si solo hay una opción y si esta tiene un value vacío
                    if (
                        opcionesFiltradas.length === 1 &&
                        opcionesFiltradas[0].value === ''
                    ) {
                        horarioSelect.style.display = "none"; // Ocultar el select
                        horarioSelect.required = false; // Quitar el atributo required
                    } else {
                        horarioSelect.style.display = ""; // Mostrar el select
                        horarioSelect.required = true; // Hacerlo obligatorio
                    }
                } else {
                    horarioSelect.style.display = "none"; // Ocultar si no hay opciones
                    horarioSelect.required = false; // Quitar la obligatoriedad
                }
            } else {
                // Si no hay radio seleccionado, ocultar el select y limpiar
                horarioSelect.style.display = "none";
                horarioSelect.required = false;
            }
        };

        const updateCarreraSelect = () => {
            const selectedRadio = document.querySelector(`input.${radioName}[type="radio"]:checked`);
            const selectedHorarioOption = horarioSelect.options[horarioSelect.selectedIndex];
            carreraSelect.innerHTML = ''; // Limpiar el select

            if (selectedRadio && selectedHorarioOption) {
                const moduloRadio = selectedRadio.dataset.modulo; // Obtener data-modulo del radio seleccionado
                const horarioOption = selectedHorarioOption.dataset.horario; // Obtener data-horario del option seleccionado

                // Filtrar opciones que coincidan con el módulo y horario seleccionados
                const opcionesCarrera = Array.from(hiddenOptionsContainerC.querySelectorAll('option'))
                    .filter(option =>
                        option.dataset.modulo === moduloRadio &&
                        option.dataset.horario === horarioOption
                    );

                if (opcionesCarrera.length > 0) {
                    opcionesCarrera.forEach(option => {
                        const nuevaOpcion = option.cloneNode(true);
                        carreraSelect.appendChild(nuevaOpcion);
                    });

                    carreraSelect.style.display = "";
                    carreraSelect.required = true;
                } else {
                    carreraSelect.style.display = "none";
                    carreraSelect.required = false;
                }
            } else {
                carreraSelect.style.display = "none";
                carreraSelect.required = false;
            }
        };

        // Agregar eventos a los radio buttons y al horarioSelect
        radioButtons.forEach(button => button.addEventListener('change', () => {
            updateCodigoHiddenInput();
            updateHorarioSelect();
            updateCarreraSelect();
        }));

        horarioSelect.addEventListener('change', () => {
            updateCarreraSelect();
        });

        // Inicializar los valores al cargar la página
        updateCodigoHiddenInput();
        updateHorarioSelect();
        updateCarreraSelect();


    }

    // Aplicar la función filters a los conjuntos de elementos
    filters('tipo', 'nHorario', 'nUniOrgCodigo', 'cCodidoForm');
    filters('vtipo', 'nvHorario', 'nvUniOrgCodigo', 'vcCodidoForm');
});