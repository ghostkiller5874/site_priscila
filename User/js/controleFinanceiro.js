$(function(){
    //$('[name=parcelas],[name=intervalo]').mask('99');
    $('[name=valor],[name=preco]').maskMoney({prefix:'R$', allowNegative:true, thousands:'.', decimal:',',  affixesStay:false});
    //$('[name=vencimento]').Zebra_DatePicker();
})
