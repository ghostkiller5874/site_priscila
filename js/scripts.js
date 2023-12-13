$('[name=comprado]').click(function(){
    $.ajax({
        url:'http://localhost/site_priscila/ajax/comprado.php',
        method:'post'
    }).done(function(){
        confirm('tem certeza?');
    });
    return false;
});

$('[name=retirar]').click(function(){
    var item_id = $(this).attr('item_id');
    var el = $(this).parent().parent();
     
    
    el.fadeOut();
    return false;
});

$('.box-conta-mobile  .botao-menu-mobile').click(function(){
    //O que acontecera qndo clicar no botao menu
    var listaMenu = $('.box-conta-mobile ul');
    

    if(listaMenu.is(':hidden') == true){
        let icone = $('.botao-menu-mobile').find('i');
        icone.removeClass('fa-bars');
        icone.addClass('fa-times');
        listaMenu.slideToggle();
    }else{
        let icone = $('.botao-menu-mobile').find('i');
        icone.removeClass('fa-times');
        icone.addClass('fa-bars');
        listaMenu.slideToggle();
    }
});



//função do slide
/*
$(function(){
    var width = (parseInt($('.box-acs-single .imagem').outerWidth() + parseInt($('.box-acs-single .imagem').css('margin-right')))) * $('.box-acs-single .imagem').length;
    $('.box-acs-single').css('width',width);
    
    var numImages = 3;
    var MarginPadding = 10;

    var ident = 0;
    var count = ($('.box-acs-single .imagem').length / numImages) -1;
    var slide = (numImages * MarginPadding) + ($('.box-acs-single img').outerWidth() * numImages);

    $('.forth').click(function(){
        if(ident < count){
            ident++;
            $('.box-acs-single').animate({'margin-left':'-='+slide+'px'}, '500');
        } 
    });

    $('.forth').click(function(){
        if(ident >= 1){
            ident--;
            $('.box-acs-single').animate({'margin-left':'+='+slide+'px'}, '500');
        } 
    });
});*/

//função do slide - teste

$(function(){
    var width = (parseInt($('.carrossel .item').outerWidth() + parseInt($('.carrossel .item').css('margin-right')))) * $('.carrossel .item').length;
    $('.carrossel').css('width',width);
    
    var numImages = 0.92;//padrao 3
    var MarginPadding = 30;//padrao 30

    var ident = 0;
    var count = ($('.carrossel .item').length / numImages) -1;
    var slide = (numImages * MarginPadding) + ($('.carrossel img').outerWidth() * numImages);

    $('.forth').click(function(){
        if(ident < count){
            ident++;
            $('.carrossel').animate({'margin-left':'-='+slide+'px'}, '500');
        } 
    });

    $('.back').click(function(){
        if(ident >= 1){
            ident--;
            $('.carrossel').animate({'margin-left':'+='+slide+'px'}, '500');
        } 
    });
});