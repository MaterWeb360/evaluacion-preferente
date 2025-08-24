// ===== FUNCIONES EXISTENTES (sin cambios) =====
function getGET() {
    var loc = document.location.href;
    var getString = loc.split("?")[1];
    var GET = getString.split("&");

    let utms = {
        UtmSource: null,
        UtmMedium: null,
        UtmCampaign: null,
        gClid: null,
    };

    for (var i = 0, l = GET.length; i < l; i++) {
        let utmstring = GET[i];
        let utmSource = utmstring.search("utm_source");
        let utmMedium = utmstring.search("utm_medium");
        let utmCamp = utmstring.search("utm_campaign");
        let utmGclid = utmstring.search("gclid");

        if (utmSource !== -1) {
            var arrUtmSource = utmstring.split("=");
            utms.UtmSource = arrUtmSource.length > 0 ? arrUtmSource[1] : "";
        }
        if (utmMedium !== -1) {
            var arrUtmMedium = utmstring.split("=");
            utms.UtmMedium = arrUtmMedium.length > 0 ? arrUtmMedium[1] : "";
        }
        if (utmCamp !== -1) {
            var arrUtmCamp = utmstring.split("=");
            utms.UtmCampaign = arrUtmCamp.length > 0 ? arrUtmCamp[1] : "";
        }
        if (utmGclid !== -1) {
            var arrUtmGclid = utmstring.split("=");
            utms.gClid = arrUtmGclid.length > 0 ? arrUtmGclid[1] : "";
        }

        if (utms.UtmCampaign == null) {
            utms.UtmCampaign = "";
        }
        if (utms.UtmSource == null) {
            utms.UtmSource = "";
        }
        if (utms.UtmMedium == null) {
            utms.UtmMedium = "";
        }
        if (utms.gClid == null) {
            utms.gClid = "";
        }
    }
    return utms;
}

$.fn.serializeObject = function() {
    var obj = {};
    var arr = this.serializeArray();
    arr.forEach(function(item, index) {
        if (obj[item.name] === undefined) {
            obj[item.name] = item.value || "";
        } else {
            if (!obj[item.name].push) {
                obj[item.name] = [obj[item.name]];
            }
            obj[item.name].push(item.value || "");
        }
    });

    if (window.location.search.length > 0) {
        utms = getGET();

        if (utms.hasOwnProperty("UtmSource")) {
            obj.UtmSource = utms.UtmSource;
        }
        if (utms.hasOwnProperty("UtmMedium")) {
            obj.UtmMedium = utms.UtmMedium;
        }
        if (utms.hasOwnProperty("UtmCampaign")) {
            obj.UtmCampaign = utms.UtmCampaign;
        }
        if (utms.hasOwnProperty("gClid")) {
            obj.gClid = utms.gClid;
        }
    } else {
        obj.UtmSource = "";
        obj.UtmMedium = "";
        obj.UtmCampaign = "";
        obj.gClid = "";
    }
    return obj;
}

function sendDatos(datosForm) {
    jQuery.ajax({
        type: "POST",
        url: api,
        data: JSON.stringify(datosForm),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        beforeSend: function() {
            jQuery(".error").empty();
        },
        success: function(data) {
            console.log(data);
            window.location = typ;
        },
        error: function(e) {
            console.log(e, e.response);
        },
    });
}

// ===== NUEVA FUNCIONALIDAD DE INTERACCIÓN ENTRE CAMPOS (ACTUALIZADA) =====
document.addEventListener('DOMContentLoaded', function() {
    const sedeSelector = document.getElementById('selector-sede');
    const divSede = document.getElementById('divsede');
    const carreraSelect = document.getElementById('nUniOrgCodigo');
    
    // Deshabilitar select de carrera al cargar (sin required inicialmente)
    if (carreraSelect) {
        carreraSelect.disabled = true;
        carreraSelect.removeAttribute('required'); // Aseguramos que no tenga required
        carreraSelect.style.opacity = '0.6';
        carreraSelect.style.cursor = 'not-allowed';
    }
    
    // Verificar el módulo seleccionado por defecto al cargar la página
    const moduloPreseleccionado = document.querySelector('input[name="tipo"]:checked');
    if (moduloPreseleccionado && moduloPreseleccionado.getAttribute('data-alter') === 'true') {
        divSede.style.display = 'block';
        sedeSelector.style.display = 'block';
        sedeSelector.setAttribute('required', 'required');
        // Mantener carrera deshabilitada hasta elegir sede
        if (carreraSelect) {
            carreraSelect.disabled = true;
            carreraSelect.removeAttribute('required');
            carreraSelect.style.opacity = '0.6';
            carreraSelect.style.cursor = 'not-allowed';
        }
    } else if (carreraSelect) {
        // Si no necesita sede, habilitar inmediatamente y agregar required
        carreraSelect.disabled = false;
        carreraSelect.setAttribute('required', 'required');
        carreraSelect.style.opacity = '1';
        carreraSelect.style.cursor = 'default';
    }
    
    // Mostrar selector de sede cuando se selecciona un módulo con carreras alternativas
    document.querySelectorAll('input[name="tipo"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const alter = this.getAttribute('data-alter');
            if (alter === 'true') {
                divSede.style.display = 'block';
                sedeSelector.style.display = 'block';
                sedeSelector.setAttribute('required', 'required');
                // Resetear selección de sede y deshabilitar carrera
                sedeSelector.value = '';
                if (carreraSelect) {
                    carreraSelect.disabled = true;
                    carreraSelect.removeAttribute('required'); // Quitar required
                    carreraSelect.style.opacity = '0.6';
                    carreraSelect.style.cursor = 'not-allowed';
                }
                filtrarCarrerasPorSede();
            } else {
                divSede.style.display = 'none';
                sedeSelector.style.display = 'none';
                sedeSelector.removeAttribute('required');
                // Habilitar carrera cuando no hay selección de sede y agregar required
                if (carreraSelect) {
                    carreraSelect.disabled = false;
                    carreraSelect.setAttribute('required', 'required'); // Agregar required
                    carreraSelect.style.opacity = '1';
                    carreraSelect.style.cursor = 'default';
                }
                // Mostrar todas las carreras cuando no hay selección de sede
                mostrarTodasLasCarreras();
            }
        });
    });
    
    // Filtrar carreras cuando cambia la sede y habilitar select
    if (sedeSelector) {
        sedeSelector.addEventListener('change', function() {
            filtrarCarrerasPorSede();
            // Habilitar select de carrera solo cuando se haya elegido una sede
            if (carreraSelect && this.value !== '') {
                carreraSelect.disabled = false;
                carreraSelect.setAttribute('required', 'required'); // AGREGAR REQUIRED aquí
                carreraSelect.style.opacity = '1';
                carreraSelect.style.cursor = 'default';
            } else if (carreraSelect) {
                carreraSelect.disabled = true;
                carreraSelect.removeAttribute('required'); // QUITAR REQUIRED
                carreraSelect.style.opacity = '0.6';
                carreraSelect.style.cursor = 'not-allowed';
            }
        });
    }
    
    function filtrarCarrerasPorSede() {
        const sedeSeleccionada = sedeSelector.value;
        
        if (!carreraSelect) return;
        
        // Ocultar/mostrar opciones según la sede
        Array.from(carreraSelect.options).forEach(option => {
            if (option.value && option.hasAttribute('data-sedes')) {
                const sedesCarrera = option.getAttribute('data-sedes').split(',');
                option.style.display = sedesCarrera.includes(sedeSeleccionada) ? '' : 'none';
            }
        });
        
        // Seleccionar la primera opción visible
        const primeraOpcionValida = Array.from(carreraSelect.options).find(opt => 
            opt.style.display !== 'none' && !opt.disabled
        );
        if (primeraOpcionValida && carreraSelect.value === '') {
            primeraOpcionValida.selected = true;
        }
    }
    
    function mostrarTodasLasCarreras() {
        if (!carreraSelect) return;
        
        Array.from(carreraSelect.options).forEach(option => {
            option.style.display = '';
        });
    }
    
    // Ejecutar filtrado inicial si el módulo preseleccionado requiere sede
    if (moduloPreseleccionado && moduloPreseleccionado.getAttribute('data-alter') === 'true') {
        filtrarCarrerasPorSede();
    }
});

// ===== ENVÍOS DE FORMULARIO (modificados para incluir todos los campos requeridos) =====
// ENVÍO MÓVIL
$("#mformularioAutonoma").submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let datosForm = form.serializeObject();
    delete datosForm.checkbox;
    delete datosForm.tipo;

    // Validar que si el selector de sede está visible, tenga una sede seleccionada
    if ($('#divsede').is(':visible') && $('#selector-sede').val() === '') {
        alert('Por favor, selecciona una sede primero');
        return false;
    }

    const horarioValue = $('#nvHorario option:selected').text();
    if (!horarioValue.startsWith("horario-alter")) {
        datosForm.cHorario = horarioValue;
        datosForm.nHorario = "pagina web";
    } else {
        datosForm.cHorario = "";
        datosForm.nHorario = "pagina web";
    }

    // Agregar sede al envío si está visible (convertir a valores numéricos)
    if ($('#divsede').is(':visible')) {
        const sedeSeleccionada = $('#selector-sede').val();
        datosForm.cSede = $('#selector-sede option:selected').text();
        datosForm.nSede = (sedeSeleccionada === 'lima_sur') ? '1' : '2';
    } else {
        datosForm.cSede = "";
        datosForm.nSede = "";
    }

    // Asegurar que todos los campos requeridos estén presentes
    datosForm.cCarrera = $('#nvUniOrgCodigo option:selected').html() || "";
    datosForm.nUniOrgCodigo = $('#nvUniOrgCodigo').val() || "";
    datosForm.cDni = datosForm.cDni || "";
    datosForm.cCodidoForm = $('#cCodidoForm').val() || "0xA1C5AFF9679455A233086E26B72B9A06";
    
    // Campos de marketing con valores por defecto
    datosForm.UtmSource = datosForm.UtmSource || "";
    datosForm.UtmMedium = datosForm.UtmMedium || "";
    datosForm.UtmCampaign = datosForm.UtmCampaign || "organico";
    datosForm.gClid = datosForm.gClid || "pagina web";

    console.log("datosForm", datosForm);
    sendDatos(datosForm);
});

// ENVÍO ESCRITORIO
$("#formularioAutonoma").submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let datosForm = form.serializeObject();
    delete datosForm.checkbox;
    delete datosForm.tipo;

    // Validar que si el selector de sede está visible, tenga una sede seleccionada
    if ($('#divsede').is(':visible') && $('#selector-sede').val() === '') {
        alert('Por favor, selecciona una sede primero');
        return false;
    }

    const horarioValue = $('#nHorario option:selected').text();
    if (!horarioValue.startsWith("horario-alter")) {
        datosForm.cHorario = horarioValue;
        datosForm.nHorario = "pagina web";
    } else {
        datosForm.cHorario = "";
        datosForm.nHorario = "pagina web";
    }

    // Agregar sede al envío si está visible (convertir a valores numéricos)
    if ($('#divsede').is(':visible')) {
        const sedeSeleccionada = $('#selector-sede').val();
        datosForm.cSede = $('#selector-sede option:selected').text();
        datosForm.nSede = (sedeSeleccionada === 'lima_sur') ? '1' : '2';
    } else {
        datosForm.cSede = "";
        datosForm.nSede = "";
    }

    // Asegurar que todos los campos requeridos estén presentes
    datosForm.cCarrera = $('#nUniOrgCodigo option:selected').html() || "";
    datosForm.nUniOrgCodigo = $('#nUniOrgCodigo').val() || "";
    datosForm.cDni = datosForm.cDni || "";
    datosForm.cCodidoForm = $('#cCodidoForm').val() || "0xA1C5AFF9679455A233086E26B72B9A06";
    
    // Campos de marketing con valores por defecto
    datosForm.UtmSource = datosForm.UtmSource || "";
    datosForm.UtmMedium = datosForm.UtmMedium || "";
    datosForm.UtmCampaign = datosForm.UtmCampaign || "organico";
    datosForm.gClid = datosForm.gClid || "pagina web";

    console.log("datosForm", datosForm);
    sendDatos(datosForm);
});

// FUNCIÓN DE ENVÍO (actualizada con la nueva URL)
function sendDatos(datosForm) {
    jQuery.ajax({
        type: "POST",
        url: "https://virtual.autonoma.edu.pe/Externa/UA_movil.aspx/wsObtenerDatosLandingPreCPTV2",
        data: JSON.stringify(datosForm),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        beforeSend: function() {
            jQuery(".error").empty();
        },
        success: function(data) {
            console.log(data);
            //window.location = typ;
        },
        error: function(e) {
            console.log(e, e.response);
        },
    });
}