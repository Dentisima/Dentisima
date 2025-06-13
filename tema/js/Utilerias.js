function ValidarNumerosDec(e, field) {
    // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, '-'= 45, ‘.’ = 46
    var field = $(field);
    key = e.keyCode ? e.keyCode : e.which;

    if (key == 8) return true;

    if (key > 47 && key < 58) {

        return true;
    }
    if (key == 45) {

        if (field.val().indexOf("-") < 0) {
            return true;
        }

    }
    if (key == 46) {

        if (field.val().indexOf(".") < 0) {
            return true;
        }

    }

    return false;
}

function ValidarNumerosDecSinSigno(e, field) {
    // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, '-'= 45, ‘.’ = 46
    var field = $(field);
    key = e.keyCode ? e.keyCode : e.which;

    if (key == 8) return true;

    if (key > 47 && key < 58) {

        return true;
    }
    if (key == 45) {

        if (field.val().indexOf("-") < 0) {
            return false;
        }

    }
    if (key == 46) {

        if (field.val().indexOf(".") < 0) {
            return true;
        }

    }

    return false;
}

function TotDecimales(field, Dec) {

    var field = $(field);

    if (field.val().indexOf(".") > -1) {
        var PosPto = field.val().indexOf(".") + 1;
        var TotEnc = field.val().substring(PosPto, field.val().length).length;

        if (TotEnc > Dec) {
            $(field).val(field.val().substring(0, PosPto + Dec));
        }
    }
    if (field.val().indexOf("-") > 0) {
        $(field).val("-" + $(field).val().replace("-", ""));
    }

}

function Format_Number(Monto, Decimales) {
    var Importe = new Number(Monto);
    var Valor = Importe.toFixed(Decimales);
    return Valor;
}

function currencyFormat(num,decimales) {
  return num.toFixed(decimales).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}


function VentanaPop(pagina,w,h,r){ 
  var NewWindowAdmin;
  l =(screen.width-w)/2;
  t=(screen.height-h)/2;
  NewWindowAdmin = window.open(pagina,'','location=0,menubar=no,status=0,toolbar=0,scrollbars=yes,resizable='+r+',width='+w+',height='+h+',left='+l+',top='+t);
  NewWindowAdmin.focus();
}

function ValidarCaracteres(e) {
    tecla = (document.all)?e.keyCode:e.which;
    if (tecla==8) return true;
    //patron = /\d/;
    patron =/[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.-_*]/;
    te = String.fromCharCode(tecla);
    return patron.test(te); 
}

function ValidarCodigo(e) {
    tecla = (document.all)?e.keyCode:e.which;
    if (tecla==8) return true;
    //patron = /\d/;
    patron =/[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_]/;
    te = String.fromCharCode(tecla);
    return patron.test(te); 
}

function ValidarNumeros(e) {
    tecla = (document.all)?e.keyCode:e.which;
    if (tecla==8) return true;
    //patron = /\d/;
    patron =/[0123456789]/;
    te = String.fromCharCode(tecla);
    return patron.test(te); 
}

