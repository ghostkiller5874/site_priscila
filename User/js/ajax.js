/*
$('.btn.delete').click(function(){
    var item_id = $(this).attr('item_id');
    var el = $(this).parent().parent().parent().parent();
    $.ajax({
        url:include_path+'/ajax/form.php',
        data:{id:item_id, tipo_acao:'deletar_cliente'},
        method:'post'
    }).done(function(){
        el.fadeOut();
    });
    return false;
})*/