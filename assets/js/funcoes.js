//////////////////////////////////////////////////////// REMOVE ACENTOS //////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////// REMOVE ACENTOS //////////////////////////////////////////////////////////////////////

function f_SemAcento(obj)
{
    palavra = String.fromCharCode(event.keyCode);

    var caracteresInvalidos = 'àèìòùâêîôûäëïöüáéíóúãõçÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÁÉÍÓÚÃÕÇ';
    var caracteresValidos =   'aeiouaeiouaeiouaeiouaocAEIOUAEIOUAEIOUAEIOUAOC';
    var acento = "´`^¨~";
    if(acento.indexOf(palavra)!= -1)
    {
        window.event.keyCode = 0;
    }

    if (caracteresInvalidos.indexOf(palavra) == -1)
    {
        if (caracteresValidos.indexOf(palavra) != -1) {
            window.event.keyCode = 0;
            obj.value = obj.value + palavra;
        }
    }
    else
    {
        window.event.keyCode = 0;
        nova = caracteresValidos.charAt(caracteresInvalidos.indexOf(palavra));
        obj.value =  obj.value + nova;
    }

}

/////////////////////////////////////////////////// VERIFICA SE A STRING É NUMÉRICA ////////////////////////////////////////////////////////
/////////////////////////////////////////////////// VERIFICA SE A STRING É NUMÉRICA ////////////////////////////////////////////////////////

//Verifica se string é numérica
function isNum(obj, Campo)
{
    var str = obj.value
    if(str != "")
    {
        for (var i = 0; i < str.length; i++)
        {
            var ch = str.substring(i, i + 1);
            if ((ch < '0' || '9' < ch) && (ch != '-') && (ch != '(') && (ch != ')'))
            {
                //alert('O campo ' + Campo + ' só aceita números.');
                bootbox.alert({
                    message: 'O campo ' + Campo + ' só aceita números.',
                    callback: function ()
                    {
                        obj.value = "";
                        obj.focus();
                    }
                });

                Valor = false;
                break;
            }
        }
    }
}

/////////////////////////////////////////////////// VERIFICA SE O VALOR FOI DIGITADO CORRETAMENTE ////////////////////////////////////////////////////////
/////////////////////////////////////////////////// VERIFICA SE O VALOR FOI DIGITADO CORRETAMENTE ////////////////////////////////////////////////////////

function f_FormatoValor(obj)
{
    var str = obj.value
    for (var i = 0; i < str.length; i++)
    {
        var ch = str.substring(i, i + 1);
        if ((ch < '0' || '9' < ch) && (ch != '.'))
        {
            //alert("Por favor troque a vírgula por ponto.");
            bootbox.alert({
                message: "Por favor troque a vírgula por ponto.",
                callback: function ()
                {
                    obj.value = "";
                    obj.focus();
                }
            });

            Valor = false;
            break;
        }
    }
}

/////////////////////////////////////////////////// VERIFICA SE O VALOR FOI DIGITADO CORRETAMENTE ////////////////////////////////////////////////////////
/////////////////////////////////////////////////// VERIFICA SE O VALOR FOI DIGITADO CORRETAMENTE ////////////////////////////////////////////////////////

function f_Valor(obj, Campo)
{
    var str = obj.value
    if(str != "")
    {
        for (var i = 0; i < str.length; i++)
        {
            var ch = str.substring(i, i + 1);
            if ((ch < '0' || '9' < ch) && (ch != ','))
            {
                //alert('O campo ' + Campo + ' só aceita números e vírgula.');
                bootbox.alert({
                    message: 'O campo ' + Campo + ' só aceita números e vírgula.',
                    callback: function ()
                    {
                        obj.value = "";
                        obj.focus();
                    }
                });

                Valor = false;
                break;
            }
        }
    }
}

/////////////////////////////////////////////////// VERIFICA SE DOIS CAMPOS TEM O MESMO VALOR ////////////////////////////////////////////////////////
/////////////////////////////////////////////////// VERIFICA SE DOIS CAMPOS TEM O MESMO VALOR ////////////////////////////////////////////////////////

function f_VerificaDoisCampos(obj, obj02, Campo)
{
    if(obj.value != obj02.value)
    {
        //alert('Os campos ' + Campo + ' estão com valores diferentes.');
        bootbox.alert({
            message: "Os campos " + Campo + " estão com valores diferentes!",
            callback: function ()
            {
                obj.value='';
                obj02.value='';
                obj.focus();
            }
        });
        Valor = false;
    }
    else
    {
        Valor = true;
    }
}

/////////////////////////////////////////////////// VERIFICA SE CAMPO FOI PRENECHIDO (TEXT TEXTAREA) ////////////////////////////////////////////////////////
/////////////////////////////////////////////////// VERIFICA SE CAMPO FOI PRENECHIDO (TEXT TEXTAREA) ////////////////////////////////////////////////////////

// Verifica se o campo não foi preenchido Text e Textarea
function f_Obriga_Campo_text(obj, Campo)
{
    if(obj.value == "")
    {
        bootbox.alert({
            message: "Por favor preencha o campo " + Campo + "!",
            callback: function ()
            {
                obj.focus();
            }
        });
        Valor = false;
    }
    else
    {
        Valor = true;
    }
}


// Verifica o tamanho minimo do campo digitado //
function f_Qtd_String_Minima(obj, Qtd, Campo)
{
    if(obj.value != "")
    {
        var TamanhoNome = obj.value;
        var Tamanho = TamanhoNome.length;

        if(Tamanho <= Qtd)
        {
            bootbox.alert({
                message: "Este campo " + Campo + ", precisa ter no mínimo "+Qtd+" caracteres!",
                callback: function ()
                {
                    obj.focus();
                }
            });
            Valor = false;
        }
        else
        {
            Valor = true;
        }               
    }
    else
    {
        Valor = true;
    }
}

/////////////////////////////////////////////////// VERIFICA SE CAMPO RÁDIO PRENECHIDO  ////////////////////////////////////////////////////////
/////////////////////////////////////////////////// VERIFICA SE CAMPO RÁDIO PRENECHIDO  ////////////////////////////////////////////////////////

// Verifica se o campo Radio não foi preenchido.
function f_Obriga_Campo_radio(obj, Campo, Numero)
{
    y=0;

    for(x=0; x<=(Numero-1);x++)
    {
        if(obj[x].checked == false)
        {
            y++;
        }
    }
    if(x == y)
    {
        bootbox.alert({
            message: "Por favor preencha o campo " + Campo + "!",
            callback: function ()
            {

            }
        });
        Valor = false;
    }
    else
    {
        Valor = true;
    }
}

/////////////////////////////////////////////////// VALIDAÇÃO DE DATAS ////////////////////////////////////////////////////////
/////////////////////////////////////////////////// VALIDAÇÃO DE DATAS ////////////////////////////////////////////////////////

// Validação da Data.
function ValidarData(obj, Campo)
{
    if (obj.value != "")
    {
        var str = obj.value
        // Verifica se os caracteres são números e barra.
        for (var i = 0; i < str.length; i++)
        {
            var ch = str.substring(i, i + 1);
            if ((ch < "0" || "9" < ch) && ch != "/")
            {
                alert('O campo ' + Campo + ' só aceita Números e barras.');
                obj.focus();
                Valor = false;
                break;
            }
        }
        // Verifica se foram digitados 10 caracteres.
        if (str.length != 10)
        {
            alert('O campo ' + Campo + ' não foi digitado corretamente.')
            obj.focus();
            Valor = false;
        }
        // Verifica o valor do dia.
        else if ( (str.substring(0, 2) < 1) || (str.substring(0, 2) > 31) )
        {
            alert('O campo ' + Campo + ' esta com o dia incorreto.');
            obj.focus();
            Valor = false;
        }
        // Verifica o valor do dia no valor do mês.
        // Fevereiro
        else if ( (str.substring(3, 5) == 2 ) && (str.substring(0, 2) > 29) )
        {
            alert('Fevereiro só tem 28 dias.');
            obj.focus();
            Valor = false;
        }
        else if ( (str.substring(3, 5) == 2 ) && (str.substring(0, 2) == 29) )
        {
            alert('Este ano fevereiro vai até 29 dias.');
            obj.focus();
            Valor = false;
        }
        // Abril
        else if ( (str.substring(3, 5) == 4 ) && (str.substring(0, 2) > 30) )
        {
            alert('Abril tem 30 dias.');
            obj.focus();
            Valor = false;
        }
        // Junho
        else if ( (str.substring(3, 5) == 6 ) && (str.substring(0, 2) > 30) )
        {
            alert('Junho tem 30 dias.');
            obj.focus();
            Valor = false;
        }
        // Setembro
        else if ( (str.substring(3, 5) == 9 ) && (str.substring(0, 2) > 30) )
        {
            alert('setembro tem 30 dias.');
            obj.focus();
            Valor = false;
        }
        // Novembro
        else if ( (str.substring(3, 5) == 11 ) && (str.substring(0, 2) > 30) )
        {
            alert('Novembro tem 30 dias.');
            obj.focus();
            Valor = false;
        }
        // Verifica o valor do mês.
        else if ( (str.substring(3, 5) < 1) || (str.substring(3, 5) > 12) )
        {
            alert('O ano só tem 12 meses.');
            obj.focus();
            Valor = false;
        }
        // Verifica o valor do ano.
        else if ( (str.substring(6, 10) < 1900) )
        {
            alert('O ano tem que ser maior que 1900.');
            obj.focus();
            Valor = false;
        }
        // Verifica posicionamento da barra.
        else if ( str.substring(3, 4) == '/' || str.substring(4, 5) == '/' )
        {
            alert('A barra esta em posição errada no campo ' + Campo + '.');
            obj.focus();
            Valor = false;
        }
        else if ( str.substring(0, 1) == '/' || str.substring(1, 2) == '/' )
        {
            alert('A barra esta em posição errada no campo ' + Campo + '.');
            obj.focus();
            Valor = false;
        }
        else if ( str.substring(6, 9) == '/' || str.substring(7, 10) == '/' )
        {
            alert('A barra esta em posição errada no campo ' + Campo + '.');
            obj.focus();
            Valor = false;
        }
        else if ( str.substring(2, 3) != '/' || str.substring(5, 6) != '/' )
        {
            alert('A barra esta em posição errada no campo ' + Campo + '.');
            Valor = false;
        }
        else
        {
            Valor = true;
        }
    }
}

/////////////////////////////////////////////////// VALIDAÇÃO DE E-MAIL  ////////////////////////////////////////////////////////   
/////////////////////////////////////////////////// VALIDAÇÃO DE E-MAIL  ////////////////////////////////////////////////////////   

// validar email
function ValidarEmail(obj)
{
    if(obj.value != "")
    {
        //Testa se o browser suporta expressões regulares
        if (window.RegExp)
        {
            var tempReg = /a/;
            if (tempReg.test("a"))
            {
                suportado = 1;
            }
        }
        if (!suportado)
        {
            if(((obj.value.indexOf(".") > 0) && (obj.value.indexOf("@") > 0)) &&
                ((obj.value.lastIndexOf(".") < (obj.value.length - 1)) &&
                (obj.value.lastIndexOf("@") < (obj.value.length -1))))
            {
                alert("Dados enviados com sucesso");
            }
            else
            {
                //alert("Favor conferir o campo e-mail!");
                bootbox.alert({
                    message: "Favor conferir o campo e-mail!",
                    callback: function ()
                    {
                        obj.focus();
                    }
                });
                Valor = false;
            }
            //Se o browser suporta expressões regulares,
            //faz a verificação completa
        }
        else
        {
            var tmp1 = /(@.*@)|(\.\.)|(@\.)|(^\.)/;
            var tmp2 = /^.+@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?)$/;
            if(!tmp1.test(obj.value) && tmp2.test(obj.value))
            {
                //alert("Os dados foram enviados com sucesso!");
            }
            else
            {
                //alert("O e-mail foi escrito de forma incorreta!");
                bootbox.alert({
                    message: "O e-mail foi escrito de forma incorreta!",
                    callback: function ()
                    {
                        obj.focus();
                    }
                });
                Valor = false;
            }
        }
    }
}

/////////////////////////////////////////////////// VALIDAÇÃO DE CNPJ  ////////////////////////////////////////////////////////   
/////////////////////////////////////////////////// VALIDAÇÃO DE CNPJ  ////////////////////////////////////////////////////////   

//validar CNPJ //
function f_Verifica_Cnpj(obj)
{
    CNPJ = obj.value;
    erro = new String;
    if (CNPJ.VALUE == "")
    {
        erro += "Preencha o campo CNPJ!";
        obj.focus();
        Valor = false;
    }
    if (CNPJ.length < 18)
    {
        erro += "CNPJ inválido!";
        obj.focus();
        Valor = false;
    }
    if ((CNPJ.charAt(2) != ".") || (CNPJ.charAt(6) != ".") || (CNPJ.charAt(10) != "/") || (CNPJ.charAt(15) != "-"))
    {
        if (erro.length == 0)
        {
            erro += "CNPJ inválido!";
            obj.focus();
            Valor = false;
        }
    }
    //substituir os caracteres que não são números
    if(document.layers && parseInt(navigator.appVersion) == 4)
    {
        x = CNPJ.substring(0,2);
        x += CNPJ. substring (3,6);
        x += CNPJ. substring (7,10);
        x += CNPJ. substring (11,15);
        x += CNPJ. substring (16,18);
        CNPJ = x;
    }
    else
    {
        CNPJ = CNPJ. replace (".","");
        CNPJ = CNPJ. replace (".","");
        CNPJ = CNPJ. replace ("-","");
        CNPJ = CNPJ. replace ("/","");
    }

    var nonNumbers = /\D/;
    if (nonNumbers.test(CNPJ)) erro += "CNPJ inválido!";
    var a = [];
    var b = new Number;
    var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
    for (i=0; i<12; i++)
    {
        a[i] = CNPJ.charAt(i);
        b += a[i] * c[i+1];
    }

    if ((x = b % 11) < 2)
    {
        a[12] = 0
    }
    else
    {
        a[12] = 11-x
    }

    b = 0;
    for (y=0; y<13; y++)
    {
        b += (a[y] * c[y]);
    }

    if ((x = b % 11) < 2)
    {
        a[13] = 0;
    }
    else
    {
        a[13] = 11-x;
    }

    if((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13]))
    {
        erro +="CNPJ inválido!";
        obj.focus();
        Valor = false;
    }

    if(erro.length > 0)
    {
        //alert(erro);
        bootbox.alert({
            message: erro,
            callback: function ()
            {

            }
        });
        return false;
    }
    return true;
}

/////////////////////////////////////////////////// VALIDAÇÃO DE CPF  ////////////////////////////////////////////////////////      
/////////////////////////////////////////////////// VALIDAÇÃO DE CPF  ////////////////////////////////////////////////////////      

//Validar Cpf
function f_Verifica_Cpf(obj)
{
    cpf = obj.value;
    erro = new String;
    if (cpf.length < 11)
    {
        erro += "CPF invalido! Tente novamente.";
        obj.value="";
        obj.focus();
        Valor = false;
    }
    var nonNumbers = /\D/;
    if ((cpf.charAt(3) != ".") || (cpf.charAt(7) != ".") || (cpf.charAt(11) != "-"))
    {
        if (erro.length == 0)
        {
            erro += "CPF invalido! Tente novamente.";
            obj.value="";
            obj.focus();
            Valor = false;
        }
    }

    //substituir os caracteres que não são números
    if(document.layers && parseInt(navigator.appVersion) == 4)
    {
        x = cpf.substring(0,2);
        x += cpf. substring (3,6);
        x += cpf. substring (7,10);
        x += cpf. substring (11,15);
        x += cpf. substring (16,18);
        cpf = x;
    }
    else
    {
        cpf = cpf. replace (".","");
        cpf = cpf. replace (".","");
        cpf = cpf. replace ("-","");
        cpf = cpf. replace ("/","");
    }

    if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
    {
        erro += "Numero de CPF invalido!"
        obj.value="";
        obj.focus();
        Valor = false;
    }
    var a = [];
    var b = new Number;
    var c = 11;
    for (i=0; i<11; i++)
    {
        a[i] = cpf.charAt(i);
        if (i < 9) b += (a[i] * --c);
    }
    if ((x = b % 11) < 2)
    {
        a[9] = 0
    }
    else
    {
        a[9] = 11-x
    }
    b = 0;
    c = 11;
    for (y=0; y<10; y++) b += (a[y] * c--);

    if ((x = b % 11) < 2)
    {
        a[10] = 0;
    }
    else
    {
        a[10] = 11-x;
    }
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]))
    {
        erro +="CPF invalido! Tente novamente.";
        obj.value="";
        obj.focus();
        Valor = false;
    }
    if (erro.length > 0)
    {
        //alert(erro);
        bootbox.alert({
            message: erro,
            callback: function ()
            {
            }
        });
        return false;
    }
    return true;
}

function f_ComparaSenha(obj,obj02,Campo,Campo02)
{
    if(obj.value != obj02.value)
    {
        //alert('Os campos ' + Campo + ' e ' + Campo02 + ' estão diferentes. Por favor corrija.')
        bootbox.alert({
            message: 'Os campos ' + Campo + ' e ' + Campo02 + ' estão diferentes. Por favor corrija.',
            callback: function ()
            {
                obj.value = "";
                obj02.value = "";
                obj.focus();
            }
        });
        Valor = false;
    }
    return true;
}