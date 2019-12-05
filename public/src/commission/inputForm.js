$(document).ready(function ()
{
    $("#commission").submit(function (e)
    {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'http://kemio.test/commission/store',
            type: "POST",
            data: $('#commission').serialize(),
            success: function (data)
            {
                $.Notification.notify('success',
                    'top center', 'OK', 'Operação realizada com sucesso!');
                document.querySelector('#commission').reset();
            },
            errors: function ()
            {
                $.Notification.notify('error',
                    'top center', 'Erro na Operação', 'Ocorreu um erro na insersão dos dados!')
            }
        });
    });
})

