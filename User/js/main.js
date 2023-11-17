$('[actionBtn=delete]').click(function () {
    var txt;
    var r = confirm("Deseja excluir o registro?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
})

$('.box-alert').fadeIn('.sucesso', setTimeout(function () {
    $('.sucesso').fadeOut();
}, 2000));
$('.box-alert').fadeIn('.erro', setTimeout(function () {
    $('.erro').fadeOut();
}, 4000));