document.addEventListener('DOMContentLoaded', () => {
    const formularioEscritorio = {
        tipo: {
            campo: document.querySelectorAll("#formularioAutonoma [name='Tipo']"),
            valido: true
        },
        nombre: {
            campo: document.querySelector('#formularioAutonoma #cNombre-3'),
            valido: false
        },
        apellidos: {
            campo: document.querySelector('#formularioAutonoma #cApellido'),
            valido: false
        },
        /*numero_documento: {
            campo: document.querySelector('#formularioAutonoma #cDni'),
            valido: false
        },*/
        celular_numero: {
            campo: document.querySelector('#formularioAutonoma #cCelular-3'),
            valido: false
        },
        email: {
            campo: document.querySelector('#formularioAutonoma #cCorreo'),
            valido: false
        },
        horario: {
            campo: document.querySelector('#formularioAutonoma #nHorario'),
            valido: true
        },
        carrera: {
            campo: document.querySelector('#formularioAutonoma #nUniOrgCodigo'),
            valido: false
        },
        politicas: {
            campo: document.querySelector('#formularioAutonoma #checkbox'),
            valido: false
        },
        submitBtn: {
            campo: document.querySelector('#formularioAutonoma #submitEscritorio'),
            valido: false
        },
        submitBtnStop: {
            campo: document.getElementById('botonHomeInitEscritorio'),
            valido: true
        }
    }

    const formularioMobile = {
        tipo: {
            campo: document.querySelectorAll("#mformularioAutonoma [name='Tipo']"),
            valido: true
        },
        nombre: {
            campo: document.querySelector('#mformularioAutonoma #cNombre-5'),
            valido: false
        },
        apellidos: {
            campo: document.querySelector('#mformularioAutonoma #cApellido-2'),
            valido: false
        },
        /*numero_documento: {
            campo: document.querySelector('#mformularioAutonoma #cDni-2'),
            valido: false
        },*/
        celular_numero: {
            campo: document.querySelector('#mformularioAutonoma #cCelular-4'),
            valido: false
        },
        email: {
            campo: document.querySelector('#mformularioAutonoma #cCorreo-2'),
            valido: false
        },
        horario: {
            campo: document.querySelector('#mformularioAutonoma #nvHorario'),
            valido: true
        },
        carrera: {
            campo: document.querySelector('#mformularioAutonoma #nvUniOrgCodigo'),
            valido: false
        },
        politicas: {
            campo: document.querySelector('#mformularioAutonoma #checkbox-2'),
            valido: false
        },
        submitBtn: {
            campo: document.querySelector('#mformularioAutonoma #submitMobile'),
            valido: false
        },
        submitBtnStop: {
            campo: document.getElementById('botonHomeInitMobile'),
            valido: true
        }
    }


    const btn_submit_init = document.getElementById('botonHomeInitEscritorio');
    const btn_submit_init_m = document.getElementById('botonHomeInitMobile');

    const aplicarBordeRojo = (campo, valido) => {
        // console.log(campo);
        if(valido === false){
            campo.style.border = '2px solid red';
        }else{
            campo.style.border = '';
        }
    };

    const comprobarLetras = (input, limite_chars, sinespacio) => {
        const pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'¨\-äöüÄÖÜëïÿËÏÜÖæÆÅøØåÅçÇđĐēĒčČěĚđĐģĢħĦīĪĳĲįĮİłŁŋŊœŒøØšŠžŽțȚțțűŰàèìòùÀÈÌÒÙâêîôûÂÊÎÔÛäëïöüÄËÏÖÜçÇžŽąĄćĆęĘłŁńŃśŚźŹżŻ]*$/;
        const spacePattern = /\s+/g;

        input.addEventListener("input", () => {
            input.value = input.value
                .split('')
                .filter(char => pattern.test(char))
                .join('');

            if (sinespacio === true) {
                input.value = input.value.replace(spacePattern, '');
            }

            if (input.value.length > limite_chars) {
                input.value = input.value.substring(0, limite_chars);
            }
        });
    };

    const comprobarDocumento = (numero) => {
        let limite_chars = 8;
        numero.minLength = 8;
        let regex = /\D/g;

        numero.addEventListener("input", () => {
            numero.value = numero.value.replace(regex, '');
            if (numero.value.length > limite_chars) {
                numero.value = numero.value.substring(0, limite_chars);
            }
        });

        numero.addEventListener("blur", () => {
            if (numero.value.length < numero.minLength) {
                numero.value = "";
            }
        });
    }

    const comprobarCelular = (numero) => {
        let limite_chars = 9;
        numero.minLength = 9;

        numero.addEventListener("input", () => {
            numero.value = numero.value.replace(/\D/g, '');
            if (numero.value.length > limite_chars) {
                numero.value = numero.value.substring(0, limite_chars);
            }
            if (numero.value.charAt(0) !== '9') {
                numero.value = '9' + numero.value.substring(1);
            }
        });

        numero.addEventListener("blur", () => {
            if (numero.value.length < numero.minLength) {
                numero.value = "";
            }
        });
    }

    const comprobarEmail = (input_email) => {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        input_email.addEventListener("blur", () => {
            if (!emailPattern.test(input_email.value)) {
                input_email.value = '';
            }
        });
    };

    const limpiarNombreYApellidos = (nombre, apellidos) => {
        nombre.addEventListener('blur', () => {
            validarDuplicados();
        });

        apellidos.addEventListener('blur', () => {
            validarDuplicados();
        });

        const validarDuplicados = () => {
            const nombreValor = nombre.value.trim().toLowerCase();
            const apellidosValor = apellidos.value.trim().toLowerCase();

            if (nombreValor === apellidosValor) {
                apellidos.value = '';
            }
        };
    };

    const verificarFormulario = (formulario) => {
        let formularioValido = true;
        for (const key in formulario) {
            if (key !== 'submitBtn' && key !== 'submitBtnStop') {
                formularioValido = formularioValido && formulario[key].valido;

                if (key !== 'tipo') {
                    aplicarBordeRojo(formulario[key].campo, formulario[key].valido);
                }
            }
        }

        formulario.submitBtn.valido = formularioValido;
        formulario.submitBtn.campo.style.display = formularioValido ? 'block' : 'none';
        formulario.submitBtnStop.campo.style.display = formularioValido ? 'none' : 'block';

        // console.log('Estado de los campos:', formulario);
    };

    const validarCampo = (formulario, campo, condicion) => {
        campo.valido = condicion(campo.campo.value);
        verificarFormulario(formulario);
    };

    // ESCRITORIO
    formularioEscritorio.nombre.campo.addEventListener('input', () => {
        validarCampo(formularioEscritorio, formularioEscritorio.nombre, (valor) => valor.trim().length > 0);
    });

    formularioEscritorio.apellidos.campo.addEventListener('input', () => {
        validarCampo(formularioEscritorio, formularioEscritorio.apellidos, (valor) => valor.trim().length > 0);
    });

    /*formularioEscritorio.numero_documento.campo.addEventListener('input', () => {
        validarCampo(formularioEscritorio, formularioEscritorio.numero_documento, (valor) => valor.trim().length >= formularioEscritorio.numero_documento.campo.minLength);
    });*/

    formularioEscritorio.celular_numero.campo.addEventListener('input', () => {
        validarCampo(formularioEscritorio, formularioEscritorio.celular_numero, (valor) => valor.trim().length >= formularioEscritorio.celular_numero.campo.minLength);
    });

    formularioEscritorio.email.campo.addEventListener('blur', () => {
        validarCampo(formularioEscritorio, formularioEscritorio.email, (valor) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor));
    });

    formularioEscritorio.carrera.campo.addEventListener('change', () => {
        validarCampo(formularioEscritorio, formularioEscritorio.carrera, (valor) => valor !== '');
    });

    formularioEscritorio.politicas.campo.addEventListener('change', () => {
        validarCampo(formularioEscritorio, formularioEscritorio.politicas, (valor) => formularioEscritorio.politicas.campo.checked);
    });

    // MOBILE
    formularioMobile.nombre.campo.addEventListener('input', () => {
        validarCampo(formularioMobile, formularioMobile.nombre, (valor) => valor.trim().length > 0);
    });

    formularioMobile.apellidos.campo.addEventListener('input', () => {
        validarCampo(formularioMobile, formularioMobile.apellidos, (valor) => valor.trim().length > 0);
    });

    /*formularioMobile.numero_documento.campo.addEventListener('input', () => {
        validarCampo(formularioMobile, formularioMobile.numero_documento, (valor) => valor.trim().length >= formularioMobile.numero_documento.campo.minLength);
    });*/

    formularioMobile.celular_numero.campo.addEventListener('input', () => {
        validarCampo(formularioMobile, formularioMobile.celular_numero, (valor) => valor.trim().length >= formularioMobile.celular_numero.campo.minLength);
    });

    formularioMobile.email.campo.addEventListener('blur', () => {
        validarCampo(formularioMobile, formularioMobile.email, (valor) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor));
    });

    formularioMobile.carrera.campo.addEventListener('change', () => {
        validarCampo(formularioMobile, formularioMobile.carrera, (valor) => valor !== '');
    });

    formularioMobile.politicas.campo.addEventListener('change', () => {
        validarCampo(formularioMobile, formularioMobile.politicas, (valor) => formularioMobile.politicas.campo.checked);
    });

    const submit_stop = (btn_submit, btn_submit_init) => {
        btn_submit.addEventListener('click', () => {
            // console.log('stop submit');
            btn_submit.style.display = 'none';
            btn_submit_init.style.display = 'block';
        })
    }

    function updateUTMs() {
        const params = new URLSearchParams(window.location.search);
        const utmFields = [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
            'zc_gad',
            'gclid'
        ];

        utmFields.forEach(field => {
            const input = document.getElementById(field);
            if (input) {
                const urlValue = params.get(field);
                if (urlValue) {
                    input.value = urlValue;
                }
            }
        });
    }

    // EJECUTAR FUNCIONES ESCRITORIO
    comprobarLetras(formularioEscritorio.nombre.campo, 50, false);
    comprobarLetras(formularioEscritorio.apellidos.campo, 50, false);

    limpiarNombreYApellidos(
        formularioEscritorio.nombre.campo,
        formularioEscritorio.apellidos.campo,
    );

    comprobarCelular(formularioEscritorio.celular_numero.campo);
    comprobarEmail(formularioEscritorio.email.campo);
    //comprobarDocumento(formularioEscritorio.numero_documento.campo);

    submit_stop(formularioEscritorio.submitBtn.campo, formularioEscritorio.submitBtnStop.campo);

    // EJECUTAR FUNCIONES MOBILE
    comprobarLetras(formularioMobile.nombre.campo, 50, false);
    comprobarLetras(formularioMobile.apellidos.campo, 50, false);

    limpiarNombreYApellidos(
        formularioMobile.nombre.campo,
        formularioMobile.apellidos.campo,
    );

    comprobarCelular(formularioMobile.celular_numero.campo);
    comprobarEmail(formularioMobile.email.campo);
    //comprobarDocumento(formularioMobile.numero_documento.campo);

    submit_stop(formularioMobile.submitBtn.campo, formularioMobile.submitBtnStop.campo);

    // VERIFICAR FORMULARIO
    // verificarFormulario(formularioEscritorio);
    // verificarFormulario(formularioMobile);

    // updateUTMs();
});
