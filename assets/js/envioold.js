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
var url_page = document.location.href;
var title_page = document.title;

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


// ENVÍO MÓVIL
$("#mformularioAutonoma").submit(function(e) {
    e.preventDefault();

    const boton = $('#submitMobile');
    boton.css("display", "none");
    const span = $("<span>")
        .text("Registrarme")
        .addClass(boton.attr("class"));
    boton.after(span);

    let form = $(this);
    let datosForm = form.serializeObject();
    delete datosForm.checkbox;
    delete datosForm.tipo;

    const horarioValue = $('#nvHorario option:selected').text();
    if (!horarioValue.startsWith("horario-alter")) {
        datosForm.cHorario = horarioValue;
    } else {
        delete datosForm.cHorario;
    }

    datosForm.cCarrera = $('#nvUniOrgCodigo option:selected').html();
    console.log("datosForm", datosForm);
    sendDatos(datosForm);
});

// ENVÍO ESCRITORIO
$("#formularioAutonoma").submit(function(e) {
    e.preventDefault();

    const boton = $('#submitEscritorio');
    boton.css("display", "none");
    const span = $("<span>")
        .text("Registrarme")
        .addClass(boton.attr("class"));
    boton.after(span);

    let form = $(this);
    let datosForm = form.serializeObject();
    delete datosForm.checkbox;
    delete datosForm.tipo;

    const horarioValue = $('#nHorario option:selected').text();
    if (!horarioValue.startsWith("horario-alter")) {
        datosForm.cHorario = horarioValue;
    } else {
        delete datosForm.cHorario;
    }

    datosForm.cCarrera = $('#nUniOrgCodigo option:selected').html();
    console.log("datosForm", datosForm);
    sendDatos(datosForm);
});

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
            // window.location = typ;
        },
        error: function(e) {
            console.log(e, e.response);
        },
    });
}