$(document).ready(function ()
{
    function limpa_formulário_cep ()
    {
        $("#cep").val("").focus();
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
    }
    $("#cep").blur(function ()
    {
        let cep = $(this).val().replace(/\D/g, '');
        if (cep != "")
        {
            let validacep = /^[0-9]{8}$/;
            if (validacep.test(cep))
            {
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados)
                {
                    if (!("erro" in dados))
                    {
                        $("#rua").val(dados.logradouro + ', ');
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $(`#uf option[value=${dados.uf}]`).attr('selected', 'selected');;
                    } //end if.
                    else
                    {
                        $.Notification.autoHideNotify('error',
                            'top center', 'CEP NÃO ENCONTRADO', 'Digite CEP Válido !');
                        limpa_formulário_cep();
                    }
                });
            } //end if.
            else
            {
                $.Notification.autoHideNotify('error',
                    'top center', 'CEP INVALIDO!', 'Digite CEP Válido !');
                limpa_formulário_cep();

            }
        } //end if.
        else
        {
            limpa_formulário_cep();
        }
    });
});